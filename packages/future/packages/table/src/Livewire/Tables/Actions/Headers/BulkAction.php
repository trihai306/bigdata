<?php

namespace Future\Table\Livewire\Tables\Actions\Headers;

class BulkAction
{
    public string $name;
    public string $label;
    public string $icon;
    public string $color = 'primary';
    public string $class = 'btn';

    public function __construct(string $name, string $label, string $icon, string $color)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function make(string $name, string $label = null, string $icon = null, string $color = 'secondary')
    {
        return new static($name, $label, $icon, $color);
    }

    public function setClass(string $class)
    {
        $this->class = $class;
        return $this;
    }

    public function render()
    {
        $icon = $this->icon;
        $class = $this->class . ' btn-' . $this->color;
        $label = $this->label;
        return view('future::livewire.table.actions.bulk-action', compact('class', 'icon', 'label'));
    }
}
