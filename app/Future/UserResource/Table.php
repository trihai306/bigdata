<?php

namespace App\Future\UserResource;

use Adminftr\Table\Future\BaseTable;
use App\Future\UserResource\Modal\ChangePassword;
use App\Models\User;
use Carbon\Carbon;
use Adminftr\Notifications\Future\Notification;
use Adminftr\Table\Future\Components\Actions\Action;
use Adminftr\Table\Future\Components\Actions\Actions;
use Adminftr\Table\Future\Components\BulkActions\BulkAction;
use Adminftr\Table\Future\Components\Columns\ImageColumn;
use Adminftr\Table\Future\Components\Columns\TextColumn;
use Adminftr\Table\Future\Components\Filters\DateFilter;
use Adminftr\Table\Future\Components\Filters\SelectFilter;
use Adminftr\Table\Future\Components\Filters\TextFilter;
use Adminftr\Table\Future\Components\Headers\Actions\ResetAction;
use Adminftr\Widgets\Future\Widgets\Widget;
use Illuminate\Support\HtmlString;
use Spatie\Permission\Models\Role;

class Table extends BaseTable
{
    protected string $model = User::class;

    protected array $select = ['phone', 'email'];

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            ImageColumn::make('avatar', __('user_avatar')),
            TextColumn::make('name', __('Họ và tên'))->searchable()->sortable()->description(function (User $user) {
                return new HtmlString("<p>số điện thoại: {$user->phone}</p>");
            }),
            TextColumn::make('birthday','Ngày sinh')->dateTime(),
            TextColumn::make('type','vai trò')->badge([
                'buyer' => 'primary',
                'seller' => 'danger',
                'admin' => 'success',
            ], [
                'buyer' => 'Người mua',
                'user' => 'Người bán',
                'admin' => 'Quản trị viên',
            ]),
            TextColumn::make('status', __('Trạng thái'))->badge(
                [
                    'active' => 'success',
                    'inactive' => 'danger',
                ],
                [
                    'active' => __('Hoạt động'),
                    'inactive' => __('Khóa'),
                ]
            ),
            TextColumn::make('gender', __('giới tính'))->badge([
                'male' => 'primary',
                'female' => 'danger',
            ], [
                'male' => 'Nam',
                'female' => 'Nữ',
            ]),
            TextColumn::make('created_at', __('Created At'))->dateTime()->sortable(),
            TextColumn::make('updated_at', __('Updated At'))->dateTime()->sortable(),
        ];
    }

    protected function filters(): array
    {

        return [
            TextFilter::make('name', __('user_name')),
            TextFilter::make('email', __('user_email')),
            TextFilter::make('address', __('user_address')),
            TextFilter::make('phone', __('user_phone')),
            SelectFilter::make('status', __('user_status'))->options([
                ['id' => 'active', 'label' => 'active'],
                ['id' => 'inactive', 'label' => 'inactive'],
                ['id' => 'blocked', 'label' => 'blocked'],
            ]),
            SelectFilter::make('gender', __('user_gender'))->options(
                [
                    ['id' => 'male', 'label' => 'nam'],
                    ['id' => 'female', 'label' => 'nữ'],
                    ['id' => 'non-binary', 'label' => 'không nhị phân'],
                    ['id' => 'genderqueer', 'label' => 'giới tính lập dị'],
                    ['id' => 'transgender', 'label' => 'chuyển giới'],
                    ['id' => 'genderfluid', 'label' => 'giới tính linh hoạt'],
                    ['id' => 'agender', 'label' => 'không giới tính'],
                ]
            ),
            DateFilter::make('birthday', __('user_birthday')),
            DateFilter::make('created_at', __('user_created_at')),
            DateFilter::make('updated_at', __('user_updated_at')),
        ];
    }

    protected function actions(Actions $actions)
    {
        return $actions->create([
            Action::make('edit', __('edit'), 'fas fa-edit')->link(function ($data) {
                return route('admin.users.edit', $data->id);
            })->size('font-size:20px;'),
            Action::make('delete', __('delete'), 'fas fa-trash-alt')->confirm('Xóa', function ($data) {
                $name = $data->name;
                return 'Bạn có chắc chắn muốn xóa người dùng '.$name.' không?';
            }, function ($model) {
                $model->delete();
                $this->dispatch('swalSuccess', ['message' => 'Xóa thành công']);
            }),
        ]);
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make(),
            \Adminftr\Table\Future\Components\Headers\Actions\Action::make('create', __('future::messages.add_data'))
                ->to(route('admin.users.create')),
        ];
    }

    protected function bulkActions(): array
    {
        return [
            BulkAction::make(
                'deletes',
                __('deletes'),
                'fas fa-trash-alt',
                __('Are you sure you want to deletes User?')
            )
                ->callback(function ($data) {
                    User::destroy($data);
                }),
        ];
    }

}
