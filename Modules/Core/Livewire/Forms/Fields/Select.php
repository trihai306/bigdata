<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

class Select extends Field
{
    protected $options = [];
    protected $label = null;

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function modelData(string $modelClass, \Closure $transform)
    {
        $models = $modelClass::all();
        $this->options = $models->mapWithKeys($transform)->toArray();
        return $this;
    }

    public function relation(callable $callback)
    {
        $callback($this);
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function render()
    {
        return view('core::base.form.select', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
            'label' => $this->label,
            'name' => $this->name,
        ]);
    }
}
