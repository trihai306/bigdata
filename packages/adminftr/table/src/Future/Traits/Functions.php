<?php

namespace Future\Table\Future\Traits;

trait Functions
{
    public function getListeners()
    {
        return array_merge($this->setListeners(), [
            'delete' => 'delete',
            'bulk' => 'bulk',
        ]);
    }

    /**
     * Set the listeners for the component.
     */
    protected function setListeners(): array
    {
        return [];
    }

    public function delete($data): void
    {

        try {
            $this->model::destroy($data['id']);
            $this->dispatch('swalSuccess', ['message' => 'Xóa thành công']);
        } catch (Exception $e) {
            $this->dispatch('swalError', ['message' => 'Xóa thất bại']);
        }
    }

    public function bulk($data, $name): void
    {
        $bulkActions = $this->bulkActions();
        foreach ($bulkActions as $bulkAction) {
            if ($bulkAction->name == $name) {
                call_user_func($bulkAction->callback, $data);
            }
        }
        $this->dispatch('reset-select');
    }

    protected function resetSelect()
    {
        $this->selectAll = false;
        $this->selectedRows = [];
        $this->dispatch('reset-select');
    }
}
