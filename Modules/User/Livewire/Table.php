<?php

namespace Modules\User\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Livewire\BaseTable;
use Modules\Core\Livewire\Tables\Actions\Action;
use Modules\Core\Livewire\Tables\Actions\Actions;
use Modules\Core\Livewire\Tables\Columns\TextColumn;
use Modules\Core\Livewire\Tables\FilterInput;

class Table extends BaseTable
{
    protected string $model = User::class;
    public string $urlCreate = 'admin.user.create';
    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            TextColumn::make('name', __('user_name'))->searchable()->sortable()
                ->renderHtml(function (User $user) {
                    return "<a href='" . route('admin.user.edit', $user->id) . "' class='text-decoration-none'>{$user->name}</a>";
                })->copy(),
            TextColumn::make('email', __('user_email'))->searchable()->sortable()->hideMiddle()->copy(),
            TextColumn::make('roles', __('user_roles'))->renderHtml(function (User $user) {
                return $user->roles->map(function ($role) {
                    return "<span class='badge bg-primary'>{$role->name}</span>";
                })->implode(' ');
            }),
            TextColumn::make('created_at', __('Created At'))->sortable(),
            TextColumn::make('updated_at', __('Updated At'))->sortable(),
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
