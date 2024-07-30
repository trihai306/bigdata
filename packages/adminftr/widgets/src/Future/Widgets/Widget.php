<?php

namespace Adminftr\Widgets\Future\Widgets;

use Adminftr\Widgets\Future\Traits\WidgetTrait;

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

    public function icon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function color($color)
    {
        $this->color = $color;

        return $this;
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
