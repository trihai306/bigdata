<?php

namespace Adminftr\Form\Future\Components\Fields;

use Adminftr\Form\Future\Components\Field;

class Checkbox extends Field
{
    public array $options = [];

    public array $descriptions = [];

    public bool $multiple = false;

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function description(array $descriptions)
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function render()
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = ! empty($this->classes) ? 'form-check-input '.$this->classes : 'form-check-input';
        $attributes = $this->getAttributes();
        $checked = $this->defaultValue ? 'checked' : '';
        $name = $this->name;
        $label = $this->label;
        $canHide = $this->canHide;
        $options = $this->options;
        $multiple = $this->multiple;
        $reactive = $this->reactive;
        $descriptions = $this->descriptions;

        return view('form::base.form.checkbox',
            compact('required', 'classes', 'options', 'multiple', 'reactive',
                'canHide', 'attributes', 'checked', 'name', 'label', 'descriptions'
            ));
    }
}
