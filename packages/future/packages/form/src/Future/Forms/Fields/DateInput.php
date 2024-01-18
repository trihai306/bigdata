<?php

namespace Future\Form\Future\Forms\Fields;

use Illuminate\Support\Facades\View;
use Future\Form\Future\Forms\Field;

class DateInput extends Field
{
    protected $placeholder = '';
    protected $label = null;

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function defaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function render()
    {
        return View::make('future::base.form.dateinput', [
            'name' => $this->name,
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'defaultValue' => $this->defaultValue,
        ])->render();
    }
}
