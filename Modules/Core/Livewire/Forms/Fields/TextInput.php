<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

class TextInput extends Field
{
    protected $isEmail = false;
    protected $isPassword = false;
    protected $placeholder = '';
    protected $maxLength = null;
    protected $pattern = null;
    protected $autocomplete = 'on';
    protected $readOnly = false;
    protected $disabled = false;
    protected $size = null;
    protected $step = null;
    protected $label = null;

    public function email()
    {
        $this->isEmail = true;
        return $this;
    }

    public function password()
    {
        $this->isPassword = true;
        return $this;
    }

    public function placeholder(string $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function maxLength(int $maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    public function pattern(string $pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function autocomplete(string $autocomplete)
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function readOnly(bool $readOnly)
    {
        $this->readOnly = $readOnly;
        return $this;
    }

    public function disabled(bool $disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function size(int $size)
    {
        $this->size = $size;
        return $this;
    }

    public function step(float $step)
    {
        $this->step = $step;
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function render()
    {

        $type = $this->isEmail ? 'email' : ($this->isPassword ? 'password' : 'text');
        $required = $this->isRequired;
        $name = $this->name;
        $classes = $this->classes;
        $attributes = $this->getAttributes();
        $defaultValue = $this->defaultValue;
        $placeholder = $this->placeholder;
        $maxLength = $this->maxLength;
        $pattern = $this->pattern;
        $autocomplete = $this->autocomplete;
        $readOnly = $this->readOnly;
        $disabled = $this->disabled;
        $size = $this->size;
        $step = $this->step;
        $label = $this->label;

        return view('core::base.form.textInput', compact('type', 'name','required', 'classes', 'attributes', 'defaultValue', 'placeholder', 'maxLength', 'pattern', 'autocomplete', 'readOnly', 'disabled', 'size', 'step', 'label'));
    }
}
