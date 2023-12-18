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
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'class="form-check-input '.$this->classes.'"' : 'class="form-check-input"';
        $attributes = $this->getAttributes();
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $checked = $value == $this->defaultValue ? 'checked' : '';
            $optionsHtml .= "<div class=\"form-check\"><input type=\"radio\" name=\"{$this->name}\" value=\"{$value}\" wire:model=\"data.{$this->name}\" {$required} {$classes} {$attributes} {$checked}><label class=\"form-check-label\" for=\"{$this->name}\">{$label}</label></div>";
        }
        $labelHtml = $this->label ? "<label>{$this->label}</label>" : '';
        return "{$labelHtml}{$optionsHtml}";
    }
}
