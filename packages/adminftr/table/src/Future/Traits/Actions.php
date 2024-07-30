<?php

namespace Adminftr\Table\Future\Traits;

use Illuminate\Database\Eloquent\Model;

trait Actions
{
    protected function defineActions(?Model $data = null)
    {
        return $this->actions(new \Adminftr\Table\Future\Components\Actions\Actions())->data($data)->schema()->render();
    }

    abstract protected function actions(\Adminftr\Table\Future\Components\Actions\Actions $actions);

    protected function getActions()
    {
        return $this->actions(new \Adminftr\Table\Future\Components\Actions\Actions());
    }

    protected function headerActions(): array
    {
        return [];
    }

    protected function defineFilters(): array
    {
        return $this->filters();
    }

    protected function bulkActions(): array
    {
        return [];
    }
}
