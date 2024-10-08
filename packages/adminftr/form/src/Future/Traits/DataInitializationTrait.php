<?php

namespace Adminftr\Form\Future\Traits;

trait DataInitializationTrait
{
    protected array $selectColumns = [];
    private function initializeData($inputs)
    {
        if ($this->id && $this->model) {
            $this->loadModelData($inputs);
        } else {
            $this->loadDefaultData($inputs);
        }
    }

    private function loadModelData($inputs)
    {
        $fieldNames = array_map(fn ($input) => $input->name, array_filter($inputs, fn ($input) => $input->canHide !== true));
        $relations = [];
        $fields = [];
        foreach ($fieldNames as $fieldName) {
            if (str_contains($fieldName, '_confirmation')) {
                $fieldName = str_replace('_confirmation', '', $fieldName);
                $fields[] = $fieldName;
            } elseif (str_contains($fieldName, '.')) {
                $parts = explode('.', $fieldName);
                $fieldName = str_replace('.', '_', $fieldName);
                $relations[$parts[0]] = $fieldName;
            } else {
                $fields[] = $fieldName;
            }
        }
        $fields = array_merge($fields, $this->selectColumns);
        $this->model = $this->model::with(array_keys($relations))->select($fields)->find($this->id);
        if ($this->model) {
            $this->data = $this->model->toArray();
            // Reassign the relationship data to the original field names
            foreach ($relations as $relation => $fieldName) {
                if (isset($this->data[$relation])) {
                    $this->data[$fieldName] = $this->data[$relation];
                    unset($this->data[$relation]);
                }
            }
        } else {
            $this->data = [];
        }
    }

    private function loadDefaultData($inputs)
    {
        foreach ($inputs as $input) {
            $this->data[$input->name] = $input->defaultValue;
        }
    }
}
