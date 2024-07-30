<?php

namespace Adminftr\Widgets\Future\Widgets;

use Adminftr\Widgets\Future\Traits\WidgetTrait;

class ProgressWidget
{
    use WidgetTrait;

    public string $image;

    public int $progress;

    public array $actionButtons = [];

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public static function make(string $title, string $description): self
    {
        return new self($title, $description);
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setProgress(int $progress): void
    {
        $this->progress = $progress;
    }

    public function setActionButtons(array $button): void
    {
        $this->actionButtons[] = (object) $button;
    }

    public function render()
    {
        return view('widget::progress-widget', [
            'data' => $this,
        ]);
    }
}
