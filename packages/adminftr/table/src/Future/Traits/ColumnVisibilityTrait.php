<?php

namespace Future\Table\Future\Traits;

/**
 * Trait ColumnVisibilityTrait
 *
 * This trait is used to handle column visibility in Livewire components.
 */
trait ColumnVisibilityTrait
{
    /**
     * The visibility of each column.
     *
     * @var array
     */
    public $columnVisibility = [];

    /**
     * Initialize the column visibility.
     *
     * @return void
     */
    public function mount()
    {
        foreach ($this->defineColumns() as $column) {
            $columnName = str_replace('.', '_', $column->name);
            $this->columnVisibility[$columnName] = $column->visible;
        }
    }

    public function updatedColumnVisibility($value, $column)
    {
        $column = str_replace('_', '.', $column);
        $this->columnVisibility[$column] = $value;
    }
}
