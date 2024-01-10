<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

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
        return view('future::base.form.textarea', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'name' => $this->name,
        ]);
    }
}
