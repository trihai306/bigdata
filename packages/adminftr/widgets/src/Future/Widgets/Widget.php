<?php

namespace Future\Widgets\Future\Widgets;

use Future\Widgets\Future\Traits\WidgetTrait;

class Widget
{
    use WidgetTrait;

    public string $icon;

    public string $color = 'primary';

    public $callback;

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public static function make(string $title, string $description): self
    {
        return new self($title, $description);
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function setColor($color): void
    {
        $this->color = $color;
    }

    public function callback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    public function render()
    {
        if ($this->callback) {
            call_user_func($this->callback, $this);
        }

        return view('widget::base-widget', [
            'data' => $this,
        ]);
    }
}
