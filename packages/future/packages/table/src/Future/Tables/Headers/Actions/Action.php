<?php
namespace Future\Tables\Headers\Actions;

use Livewire\Component;

class Action
{
    protected string $name;
    protected string $label;
    protected ?string $icon;
    protected ?string $color;
    protected ?string $modal;

    public function __construct(string $name, string $label, ?string $icon = null, ?string $color = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->color = $color;
    }

    public static function make(string $name, string $label, ?string $icon = null, ?string $color = null): self
    {
        return new static($name, $label, $icon, $color);
    }

    public function modal()
    {

    }
}
