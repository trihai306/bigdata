<?php

namespace Future\Form\Livewire\Forms\Fields;

use Future\Form\Livewire\Forms\Field;

class PhoneNumber extends Field
{
    protected $placeholder = '';
    protected $maxLength = 10;
    protected $pattern = "/^[0-9]*$/"; // chỉ cho phép nhập số
    protected $label = null;

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

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function render()
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'class="form-control '.$this->classes.'"' : 'class="form-control"';
        $attributes = $this->getAttributes();
        $placeholder = isset($this->placeholder) ? 'placeholder="'.$this->placeholder.'"' : '';
        $maxLength = isset($this->maxLength) ? 'maxlength="'.$this->maxLength.'"' : '';
        $pattern = isset($this->pattern) ? 'pattern="'.$this->pattern.'"' : '';
        $label = isset($this->label) ? "<label for=\"{$this->name}\">{$this->label}</label>" : '';
        return "{$label}<input type=\"tel\" name=\"{$this->name}\" wire:model=\"data.{$this->name}\" {$required} {$classes} {$attributes} {$placeholder} {$maxLength} {$pattern}>";
    }
}
