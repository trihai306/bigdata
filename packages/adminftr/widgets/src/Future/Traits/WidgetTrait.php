<?php

namespace Adminftr\Widgets\Future\Traits;

trait WidgetTrait
{
    public string $title;

    public string $description;

    public array $extraAttributes = [];

    public array $col = ['md' => 6, 'xl' => 3];

    public function title(string $title): void
    {
        $this->title = $title;
    }

    public function description(string $description): void
    {
        $this->description = $description;
    }

    public function setExtraAttributes(array $extraAttributes): void
    {
        $this->extraAttributes = $extraAttributes;
    }

    public function setCol(array $col): void
    {
        $this->col = $col;
    }
}
