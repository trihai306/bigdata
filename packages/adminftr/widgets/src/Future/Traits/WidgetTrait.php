<?php

namespace Future\Widgets\Future\Traits;

use Carbon\Carbon;
use Livewire\Attributes\Url;

trait WidgetTrait
{
    public string $title;
    public string $description;
    public array $extraAttributes = [];
    public array $col = ['md' => 6, 'xl' => 3];

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
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
