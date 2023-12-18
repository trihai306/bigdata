<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

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
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'class="form-control '.$this->classes.'"' : 'class="form-control"';
        $attributes = $this->getAttributes();
        $placeholder = isset($this->placeholder) ? 'placeholder="'.$this->placeholder.'"' : '';
        $label = isset($this->label) ? "<label for=\"{$this->name}\">{$this->label}</label>" : '';
        return "{$label}<input type=\"date\" name=\"{$this->name}\" wire:model=\"data.{$this->name}\" {$required} {$classes} {$attributes} {$placeholder}>";
    }
}
