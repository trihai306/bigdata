<?php

namespace Future\Table\Future\Traits;

use Livewire\Attributes\Url;

/**
 * Trait SelectTrait
 *
 * This trait is used to handle row selection in Livewire components.
 */
trait SelectTrait
{
    /**
     * Indicates if all rows are selected.
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * The selected rows.
     *
     * @var array
     */
    #[Url(as: 'se')]
    public $selectedRows = [];

    public function resetFiltersSelect()
    {
        foreach ($this->selectedRows as $column => $value) {
            $this->selectedRows[$column] = '';
        }
    }

    public function SelectedRows($query)
    {
        foreach ($this->selectedRows as $column => $value) {
            if (! empty($value)) {
                $query->where($column, $value);
            }
        }

        return $query;
    }
}
