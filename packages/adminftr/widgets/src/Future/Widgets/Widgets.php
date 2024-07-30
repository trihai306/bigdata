<?php

namespace Adminftr\Widgets\Future\Widgets;

class Widgets
{
    public string $icon;

    public string $title;

    public string $description;

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

    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function callback($callback): self
    {
        $this->callback = $callback;

        return $this;
    }

    public function render()
    {
        if ($this->callback) {
            call_user_func($this->callback, $this);
        }

        return view('widget::widgets', [
            'data' => $this,
        ]);
    }
}
