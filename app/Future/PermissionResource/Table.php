<?php

namespace App\Future\PermissionResource;

use App\Future\PermissionResource\Modal\Form;
use Adminftr\Table\Future\BaseTable;
use Adminftr\Table\Future\Components\Actions\Action;
use Adminftr\Table\Future\Components\Actions\Actions;
use Adminftr\Table\Future\Components\Columns\TextColumn;
use Adminftr\Table\Future\Components\FilterInput;
use Adminftr\Table\Future\Components\Headers\Actions\ResetAction;
use Adminftr\Widgets\Future\Widgets\Widget;
use Spatie\Permission\Models\Permission;

class Table extends BaseTable
{
    protected string $model = Permission::class;

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
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
        return $actions->create(
            [
                Action::make('edit', __('edit'), 'fas fa-edit')->modal(Form::class),
                Action::make('delete', __('delete'), 'fas fa-trash-alt')->confirm(function ($data) {
                    return [
                        'message' => __('Are you sure you want to delete this permission?'),
                        'params' => $data, 'nameMethod' => 'delete',
                    ];
                }),
            ]
        );
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make(),
            \Future\Table\Future\Components\Headers\Actions\Action::make('create', __('Create Permission'))
                ->modal('create', Form::class),
        ];
    }

    protected function widgets()
    {
        $count = $this->model::query()->count();

        $widgetCountPermission = Widget::make($count.' Permissions', '', 'fa fa-key');
        $widgetCountPermission->setColor('green');
        $widgetCountPermission->setCol(['md' => 5, 'xl' => 4]);

        return [
            $widgetCountPermission,
        ];
    }
}
