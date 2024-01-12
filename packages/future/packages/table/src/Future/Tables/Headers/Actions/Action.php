<?php
namespace Future\Tables\Headers\Actions;

class Action
{
    protected string $name;
    protected string $label;
    protected ?string $icon;
    protected ?string $color;
    protected ?string $url;

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

    public function to($url): self
    {
        $this->url = $url;

        return $this;
    }



    public function render()
    {
        return view('future::table.actions.action', [
            'name' => $this->name,
            'label' => $this->label,
            'icon' => $this->icon,
            'color' => $this->color,
            'url' => $this->url,
        ]);
    }
}
