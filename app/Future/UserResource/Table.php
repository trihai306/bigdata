<?php

namespace App\Future\UserResource;

use App\Models\User;
use Future\Table\Future\BaseTable;
use Future\Table\Future\Tables\Actions\Action;
use Future\Table\Future\Tables\Actions\Actions;
use Future\Table\Future\Tables\Columns\ImageColumn;
use Future\Table\Future\Tables\Columns\TextColumn;
use Future\Table\Future\Tables\FilterInput;
use Future\Table\Future\Tables\Headers\Actions\ResetAction;


class Table extends BaseTable
{
    protected string $model = User::class;
    public string $urlCreate = 'admin.users.create';

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            ImageColumn::make('avatar', __('user_avatar')),
            TextColumn::make('name', __('user_name'))->searchable()->sortable()->description(function (User $user){
                return $user->phone;
            })->width('200px'),
            TextColumn::make('address', __('user_address'))->searchable()->sortable(),
            TextColumn::make('birthday')->dateTime(),
            TextColumn::make('roles', __('user_roles'))->renderHtml(function (User $user) {
                return $user->roles->map(function ($role) {
                    return "<span class='badge bg-primary'>{$role->name}</span>";
                })->implode(' ');
            }),
            TextColumn::make('status', __('user_status'))->badge(
                [
                    'active' => 'success',
                    'inactive' => 'danger',
                ],
                [
                    'active' => __('active'),
                    'inactive' => __('inactive'),
                ]
            ),
            TextColumn::make('gender',__('gender'))->badge([
                'male'=>'primary',
                'female'=>'danger',
            ],[
                'male'=>'Nam',
                'female'=>'Nữ',
            ]),
            TextColumn::make('created_at', __('Created At'))->dateTime()->sortable(),
            TextColumn::make('updated_at', __('Updated At'))->dateTime()->sortable(),
        ];
    }

    protected function filters(): array
    {
        return [
            FilterInput::make('name'),
            FilterInput::make('phone'),
        ];
    }

    protected function actions(Actions $actions)
    {
        return $actions->create([
            Action::make('edit', __('edit'), 'fas fa-edit')->setLink(function ($data) {
                return route('admin.users.edit', $data->id);
            }),
            Action::make('delete', __('delete'), 'fas fa-trash-alt')->setConfirm(function ($data) {
                return ['message' => __('Are you sure you want to delete this permission?'), 'id' => $data->id, 'nameMethod' => 'delete'];
            }),
        ]);
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make(),
            \Future\Table\Future\Tables\Headers\Actions\Action::make('create', __('future::messages.add_data'))->to(route($this->urlCreate)),
        ];
    }
}
