<?php
namespace Modules\Core\Livewire\Tables\Columns;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Livewire\Tables\Column;

class ColorColumn extends Column
{
    public static function make(string $name, string $label = null)
    {
        return new static($name, $label);
    }

    public function render(Model $model)
    {
        $value = $model->{$this->name};
        return "<span class='badge bg-{$value}'>{$value}</span>";
    }
}
