<?php

namespace Adminftr\Table\Future\Traits;

trait Functions
{
    public function getListeners()
    {
        return array_merge($this->setListeners(), [
            'bulk' => 'bulk',
            'callbackActions' => 'callbackActions',
        ]);
    }

    /**
     * Set the listeners for the component.
     */
    protected function setListeners(): array
    {
        return [];
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

    public function callbackActions($data, $name)
    {
        $model = $this->model;
        $data = $model::find($data['id']);
        if (! $data) {
            $this->dispatch('swalError', ['message' => 'Không tìm thấy dữ liệu']);

            return;
        }
        $actions = $this->defineActions($data);
        $actions = $actions['actions'];
        foreach ($actions as $action) {
            if ($action->name == $name) {
                if ($action->callbackConfirm) {
                    call_user_func($action->callbackConfirm, $data);
                } else {
                    $this->dispatch('swalError', ['message' => 'Không tìm thấy callback']);
                }
            }
        }

    }

    public function callbackWidgets($data, $name)
    {
        $widgets = $this->defineWidgets();
        foreach ($widgets as $widget) {
            if ($widget->name == $name) {
                call_user_func($widget->callback, $data);
            }
        }
    }

    protected function resetSelect()
    {
        $this->selectAll = false;
        $this->selectedRows = [];
        $this->dispatch('reset-select');
    }
}
