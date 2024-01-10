<?php
namespace Future\Table\Future\Tables\Columns;

use Future\Table\Future\Tables\Column;
use Illuminate\Database\Eloquent\Model;

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
