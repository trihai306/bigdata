<?php

namespace Modules\User\Livewire;

use App\Models\User;
use Future\Table\Livewire\BaseTable;
use Future\Table\Livewire\Tables\Actions\Action;
use Future\Table\Livewire\Tables\Actions\Actions;
use Future\Table\Livewire\Tables\Columns\ImageColumn;
use Future\Table\Livewire\Tables\Columns\TextColumn;
use Future\Table\Livewire\Tables\FilterInput;
use Illuminate\Database\Eloquent\Model;

class Table extends BaseTable
{
    protected string $model = User::class;
    public string $urlCreate = 'admin.user.create';

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
            TextColumn::make('status', __('user_status'))->renderHtml(function (User $user) {
                return $user->status == 'active' ? "<span class='badge bg-success'>{$user->status}</span>" : "<span class='badge bg-danger'>{$user->status}</span>";
            }),
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

    protected function actions(Actions $actions, Model $data = null)
    {
       return $actions->create([
                Action::make('edit', __('edit'), 'fas fa-edit')->setLink(route('admin.user.edit', $data->id)),
                Action::make('delete', __('delete'), 'fas fa-trash-alt')->setConfirm(function () use ($data) {
                    return [
                        'message' => __('Are you sure you want to delete this user?'),
                        'id' => $data->id,
                        'nameMethod' => 'delete'
                    ];
                }),
            ]);
    }

    protected function headerAction()
    {
      return [

      ];
    }
}
