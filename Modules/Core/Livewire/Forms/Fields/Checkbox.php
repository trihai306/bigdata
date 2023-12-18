<?php

namespace Modules\Core\Livewire\Forms\Fields;

use Modules\Core\Livewire\Forms\Field;

class Checkbox extends Field
{
    public function render()
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'class="form-check-input ' . $this->classes . '"' : 'class="form-check-input"';
        $attributes = $this->getAttributes();
        $checked = $this->defaultValue ? 'checked' : '';
        return "<div class=\"form-check\"><input type=\"checkbox\" name=\"{$this->name}\" wire:model=\"data.{$this->name}\" {$required} {$classes} {$attributes} {$checked}><label class=\"form-check-label\" for=\"{$this->name}\">{$this->label}</label></div>";
    }
}
