<?php

namespace App\Future\PermissionResource;

use App\Future\PermissionResource\Modal\Form;
use Future\Table\Future\BaseTable;
use Future\Table\Future\Tables\Actions\Action;
use Future\Table\Future\Tables\Actions\Actions;
use Future\Table\Future\Tables\Columns\TextColumn;
use Future\Table\Future\Tables\FilterInput;
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
            TextColumn::make('created_at', __('Created At'))->sortable(),
            TextColumn::make('updated_at', __('Updated At'))->sortable(),
            ];
    }

    protected function filters(): array
    {
        return [FilterInput::make('name')];
    }

    protected function actions(Actions $actions)
    {
        return $actions->create([
            Action::make('edit', __('edit'), 'fas fa-edit')->modal('edit', Form::class),
            Action::make('delete', __('delete'), 'fas fa-trash-alt')->setConfirm(function ($data) {
            return ['message' => __('Are you sure you want to delete this permission?'), 'id' => $data->id, 'nameMethod' => 'delete'];
        }),
        ]);
    }

    protected function headerActions(): array
    {
        return [\Future\Table\Future\Tables\Headers\Actions\Action::make('create', __('Create Permission'))->modal('create', Form::class)];
    }
}
