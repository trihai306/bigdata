<?php

namespace Future\Form\Future\Traits;

use Exception;

trait DataPersistenceTrait
{
    private function persistData()
    {
        if ($this->id) {
            $this->updateModel();
        } else {
            $this->createModel();
        }
    }

    private function updateModel()
    {
        [$modelData, $relationshipData] = $this->separateData();
        $model = $this->model::find($this->id);
        if (! $model) {
            throw new Exception('Record not found.');
        }
        $model->update($modelData);
        foreach ($relationshipData as $relation => $data) {
            $relationParts = explode('_', $relation);
            $relation = $relationParts[1];

            if ($model->$relation()) {
                $model->$relation()->sync($data);
            }
        }

        $this->data = $model->toArray();
    }

    private function separateData()
    {
        $relationshipFields = $this->getRelationshipFields();
        $relationshipFieldNames = array_map(function ($field) {
            return str_replace('.', '_', $field->name);
        }, $relationshipFields);
        $modelData = [];
        $relationshipData = [];
        foreach ($this->data as $key => $value) {
            if (in_array($key, $relationshipFieldNames)) {
                $relationshipData[$key] = $value;
            } else {
                $modelData[$key] = $value;
            }
        }

        return [$modelData, $relationshipData];
    }

    private function createModel()
    {
        [$modelData, $relationshipData] = $this->separateData();
        $model = $this->model::create($modelData);

        foreach ($relationshipData as $relation => $data) {
            if ($model->$relation()) {
                $model->$relation()->create($data);
            }
        }
    }
}
