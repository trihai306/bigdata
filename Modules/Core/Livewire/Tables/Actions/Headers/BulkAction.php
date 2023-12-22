<?php
namespace Modules\Core\Livewire\Tables\Actions\Headers;

class BulkAction
{
    public string $name;
    public string $label;
    public string $icon;
    public string $color;

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

    public function render()
    {
        return view('core::livewire.tables.actions.headers.bulk-action');
    }
}
