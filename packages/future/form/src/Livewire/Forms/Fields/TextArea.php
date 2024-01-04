<?php

namespace Future\Form\Livewire\Forms\Fields;

use Future\Form\Livewire\Forms\Field;

class TextArea extends Field
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
        return view('core::base.form.textarea', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'name' => $this->name,
        ]);
    }
}
