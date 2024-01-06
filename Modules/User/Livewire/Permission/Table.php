<?php

namespace Modules\User\Livewire\Permission;

use Future\Table\Livewire\BaseTable;
use Future\Table\Livewire\Tables\Actions\Action;
use Future\Table\Livewire\Tables\Actions\Actions;
use Future\Table\Livewire\Tables\Columns\TextColumn;
use Future\Table\Livewire\Tables\FilterInput;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;

class Table extends BaseTable
{
    public string $urlCreate = 'admin.permissions.create';
    protected string $model = Permission::class;
    protected function columns(): array
    {
      return [
        TextColumn::make('name', __('permission_name'))->searchable()->sortable(),
        TextColumn::make('guard_name', __('Guard Name'))->searchable()->sortable(),
        TextColumn::make('created_at',__('Created At'))->sortable(),
        TextColumn::make('updated_at',__('Updated At'))->sortable(),
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
