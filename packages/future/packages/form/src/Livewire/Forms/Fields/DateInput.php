<?php

namespace Future\Form\Livewire\Forms\Fields;

use Illuminate\Support\Facades\View;
use Future\Form\Livewire\Forms\Field;

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

    public function render()
    {
        return View::make('future::base.form.dateinput', [
            'name' => $this->name,
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
        ])->render();
    }
}
