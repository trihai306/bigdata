<?php

namespace Future\Form\Future\Traits;

use Future\Form\Future\Components\Field;
use Future\Form\Future\Components\Fields\Select;

trait FieldExtractionTrait
{
    protected function getInputFields()
    {
        return $this->extractFields($this->form->render(), Field::class);
    }

    private function extractFields($fields, $type, $isRelationship = false)
    {
        return array_reduce($fields, function ($extractedFields, $field) use ($type, $isRelationship) {
            if ($field instanceof $type && (! $isRelationship || str_contains($field->name, '.'))) {
                $extractedFields[] = $field;
            } elseif (method_exists($field, 'getFields')) {
                $extractedFields = array_merge($extractedFields, $this->extractFields($field->getFields(), $type, $isRelationship));
            }

            return $extractedFields;
        }, []);
    }

    protected function getSelectFields()
    {
        return $this->extractFields($this->form->render(), Select::class);
    }

    protected function getRelationshipFields()
    {
        return $this->extractFields($this->form->render(), Field::class, true);
    }
}
