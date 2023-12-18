<?php

namespace Modules\Permission\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Modules\Core\Livewire\BaseTable;
use Modules\Core\Livewire\Tables\Actions\Action;
use Modules\Core\Livewire\Tables\Actions\Actions;
use Modules\Core\Livewire\Tables\Column;
use Modules\Core\Livewire\Tables\FilterInput;
use Spatie\Permission\Models\Permission;

class Permissions extends BaseTable
{
    public string $urlCreate = 'admin.permissions.create';
    protected string $model = Permission::class;

    protected function columns(): array
    {
      return [
        Column::make('name', __('permission_name'))->searchable()->sortable(),
        Column::make('guard_name', __('Guard Name'))->searchable()->sortable(),
        Column::make('created_at',__('Created At'))->sortable(),
        Column::make('updated_at',__('Updated At'))->sortable(),
      ];
    }

    protected function filters(): array
    {
        return [
            FilterInput::make('name')
        ];
    }

    protected function actions(Actions $actions, Model $data = null)
    {
       return $actions->create([
           Action::make('edit', __('edit'),'fas fa-edit')->setLink(route('admin.permissions.edit',$data->id)),
              Action::make('delete', __('delete'),'fas fa-trash-alt')->setConfirm(function () use ($data) {
                  return [
                      'message' => __('Are you sure you want to delete this permission?'),
                      'id' => $data->id,
                      'nameMethod' => 'delete'
                  ];
              }),
       ]);
    }
}
