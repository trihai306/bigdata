<?php
namespace Future\Table\Livewire\Tables\Actions\Headers;

class BulkAction
{
    public string $name;
    public string $label;
    public string $icon;
    public string $color;
    public string $class;

    public function __construct(string $name, string $label, string $icon, string $color)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function make(string $name, string $label=null, string $icon = null, string $color='secondary')
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
        $class= $this->class ?? 'btn btn-primary';
        return view('core::livewire.table.actions.bulk-action', compact('class'));
    }
}
