<?php

namespace Future\Table\Livewire\Tables\Traits;

trait Functions
{
    public function getListeners()
    {
        return array_merge($this->setListeners(), [
            "delete" => 'delete',
            "deleteSelect" => 'deleteSelect',
        ]);
    }

    /**
     * Set the listeners for the component.
     *
     * @return array
     */
    protected function setListeners() : array
    {
        return [];
    }

    public function delete(int $id) : void
    {
        try {
            $this->model::destroy($id);
            $this->dispatch('swalSuccess', [
                'message' => 'Xóa thành công',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swalError', [
                'message' => 'Xóa thất bại',
            ]);
        }
    }

    public function deleteSelect()
    {
        try {
            $this->model::destroy($this->selectedRows);
            $this->dispatch('swalSuccess', [
                'message' => 'Xóa thành công',
            ]);
            $this->selectAll = false;
            $this->selectedRows = [];
        } catch (\Exception $e) {
            $this->dispatch('swalError', [
                'message' => 'Xóa thất bại',
            ]);
        }
    }
}
