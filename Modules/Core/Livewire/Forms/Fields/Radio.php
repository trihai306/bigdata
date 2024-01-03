<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

class Radio extends Field
{
    protected $options = [];
    protected $label = null;

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function render()
    {
        return view('core::base.form.radio', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
            'name' => $this->name,
            'label' => $this->label,
        ]);
    }
}
