<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

class TextNumber extends Field
{
    protected $min = null;
    protected $max = null;
    protected $step = null;
    protected $label = null;
    protected $placeholder = null;

    public function min(int $min)
    {
        $this->min = $min;
        return $this;
    }

    public function max(int $max)
    {
        $this->max = $max;
        return $this;
    }

    public function step(int $step)
    {
        $this->step = $step;
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function render()
    {
        return view('core::base.form.textnumber', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'name' => $this->name,
        ]);
    }
}
