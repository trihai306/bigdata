<?php

namespace App\Future\UserResource;

use App\Future\UserResource\Modal\ChangePassword;
use App\Models\User;
use Carbon\Carbon;
use Future\Notifications\Future\Notification;
use Future\Table\Future\BaseTable;
use Future\Table\Future\Components\Actions\Action;
use Future\Table\Future\Components\Actions\Actions;
use Future\Table\Future\Components\BulkActions\BulkAction;
use Future\Table\Future\Components\Columns\ImageColumn;
use Future\Table\Future\Components\Columns\TextColumn;
use Future\Table\Future\Components\Filters\DateFilter;
use Future\Table\Future\Components\Filters\SelectFilter;
use Future\Table\Future\Components\Filters\TextFilter;
use Future\Table\Future\Components\Headers\Actions\ResetAction;
use Future\Widgets\Future\Widgets\Widget;
use Illuminate\Support\HtmlString;
use Spatie\Permission\Models\Role;

class Table extends BaseTable
{
    protected string $model = User::class;

    protected array $select = ['phone', 'email'];

    protected function setListeners(): array
    {
        return [
            'check' => 'check',
        ];
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            ImageColumn::make('avatar', __('user_avatar')),
            TextColumn::make('name', __('user_name'))->searchable()->sortable()->description(function (User $user) {
                return new HtmlString("<p>{$user->phone}</p><p>{$user->email}</p>");
            }),
            TextColumn::make('birthday')->dateTime(),
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
            TextColumn::make('gender', __('gender'))->badge([
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
            Action::make('password', __('change password'), 'fa fa-key')
                ->modal(ChangePassword::class)
                ->size('font-size:20px;'),
            Action::make('delete', __('delete'), 'fas fa-trash-alt')->confirm(function ($data) {
                return [
                    'message' => __('Are you sure you want to delete this permission?'),
                    'params' => $data, 'nameMethod' => 'delete',
                ];
            }),
        ]);
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make(),
            \Future\Table\Future\Components\Headers\Actions\Action::make('create', __('future::messages.add_data'))
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
                    Notification::make()->send();
                }),
        ];
    }

    /**
     * Thống kê tổng số người dùng (Tổng số, đang hoạt động, mới trong tháng)   - (1)
     * Thống kê tổng số người dùng có sinh nhật tháng này                       - (2)
     * Thống kê người dùng chưa điền đủ thông tin                               - (3)
     * Thống kê tổng số người dùng theo roles                                   - (4)
     */
    protected function widgets()
    {
        // (1)
        $widgetTotalUser = Widget::make('0 người dùng', '0 người dùng được kích hoạt')
            ->callback(function ($widget) {
                $currentMonth = Carbon::now()->format('m');
                $currentYear = Carbon::now()->format('Y');
                $totalUser = $this->model::query()->count();
                $activeUser = $this->model::query()->where('status', 'active')->count();
                $newUserThisMonth = $this->model::query()->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();
                $widget->title = $totalUser.' người dùng';
                $widget->description = $activeUser.' người dùng được kích hoạt';
                $widget->setIcon('fa fa-user');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('green');
                if ($newUserThisMonth > 0) {
                    $widget->setExtraAttributes(['subtitleColor' => 'text-green', 'subtitle' => '+'.$newUserThisMonth]);
                } else {
                    $widget->setExtraAttributes(['subtitle' => '+'.$newUserThisMonth]);
                }
            });

        // (2)
        $widgetBirthdayUser = Widget::make('0 người dùng có sinh nhật vào tháng này', '')
            ->callback(function ($widget) {
                $currentMonth = Carbon::now()->format('m');
                $userBirthdayCount = $this->model::query()->whereMonth('birthday', $currentMonth)
                    ->count();
                $widget->title = $userBirthdayCount.' người dùng có sinh nhật vào tháng này';
                $widget->setIcon('fa fa-cake-candles');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('pink');
            });

        // // (3)
        $widgetUnfilledInfoUser = Widget::make('0 người dùng chưa hoàn thiện hồ sơ', '')
            ->callback(function ($widget) {
                $userUnfilledInfoCount = $this->model::query()
                    ->whereNull('email')
                    ->orWhereNull('phone')
                    ->orWhereNull('address')
                    ->orWhereNull('birthday')
                    ->orWhereNull('gender')
                    ->orWhere('avatar', 'avatars/img.png')
                    ->count();
                $widget->title = $userUnfilledInfoCount.' người dùng chưa hoàn thiện hồ sơ';
                $widget->setIcon('fa fa-user-xmark');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('red');
            });

        // // (4)
        $widgetRoles = [];
        $rolesWithUserCount = Role::withCount('users')->limit(2)->get();
        foreach ($rolesWithUserCount as $role) {
            $widgetRole = Widget::make(strtoupper($role->name), '0 người dùng');
            $widgetRole->setCol(['md' => 6, 'xl' => 4]);
            $widgetRoles[] = $widgetRole;
        }

        return [
            $widgetTotalUser,
            $widgetBirthdayUser,
            $widgetUnfilledInfoUser,
            ...$widgetRoles,
        ];
    }
}
