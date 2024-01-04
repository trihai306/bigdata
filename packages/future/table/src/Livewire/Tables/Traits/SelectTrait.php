<?php

namespace Future\Table\Livewire\Tables\Traits;

/**
 * Trait SelectTrait
 *
 * This trait is used to handle row selection in Livewire components.
 */
trait SelectTrait {
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
    public $selectedRows = [];

    public function SelectedRows()
    {
        $data = $this->applyTableQuery()->paginate($this->perPage, pageName: 'page');
        $this->selectAll = count($this->selectedRows) === $data->count();
        if ($this->selectAll) {
            $this->selectedRows = $data->pluck('id')->map(fn($id) => (string) $id);
        }
        if (count($this->selectedRows) === 0) {
            $this->selectedRows = [];
        }
    }

    /**
     * Select all rows.
     *
     * @return void
     */

    public function selectAllData(){
        $data = $this->applyTableQuery()->paginate($this->perPage, pageName: 'page');
        if ($this->selectAll) {
            $this->selectedRows = $data->pluck('id')->map(fn($id) => (string) $id);
        } else {
            $this->selectedRows = [];
        }
    }
}
