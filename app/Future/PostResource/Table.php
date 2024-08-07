<?php

namespace App\Future\PostResource;

use App\Future\PostResource\Modal\Base;
use App\Models\Post;
use Adminftr\Table\Future\BaseTable;
use Adminftr\Table\Future\Components\Actions\Action;
use Adminftr\Table\Future\Components\Actions\Actions;
use Adminftr\Table\Future\Components\Columns\TextColumn;
use Adminftr\Table\Future\Components\Filters\DateFilter;
use Adminftr\Table\Future\Components\Filters\SelectFilter;
use Adminftr\Table\Future\Components\Headers\Actions\ResetAction;
use Adminftr\Widgets\Future\Widgets\Widget;
use Illuminate\Support\HtmlString;

class Table extends BaseTable
{
    protected string $model = Post::class;

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            TextColumn::make('user_id', __('User id'))->searchable()->sortable(),
            TextColumn::make('created_at', __('Ngày tạo'))->sortable(),
            TextColumn::make('title', __('Tiêu đề'))->sortable(),
//            TextColumn::make('content', __('Nội dung bàn đăng'))
//                ->description(function (Post $post) {
//                return new HtmlString("<p>{$post->field}</p><p>{$post->type}</p>");
//            }),
            TextColumn::make('content', __('Nội dung bàn đăng'))->searchable()->sortable()->description(function (Post $post) {
                return new HtmlString("<p>{$post->title}</p><p>{$post->title}</p>");
            }),
            TextColumn::make('status', __('Trạng thái'))->badge(
                [
                    'published' => 'success',
                    'waiting' => 'warning',
                    'draft' => 'danger',
                ],
                [
                    'published' => __('Hoạt Động'),
                    'waiting' => __('Khoá'),
                    'draft' => __('Nháp'),
                ]
            )
        ];
    }

    protected function filters(): array
    {
        return [
            SelectFilter::make('type', __('Trạng thái bài viết'))->options([
                ['id' => 'seeking_manufacturer', 'label' => 'Tìm kiếm nhà sản xuất'],
                ['id' => 'contract_created', 'label' => 'Đã tạo hợp đồng'],
            ]),
            DateFilter::make('created_at', __('Ngày tạo')),
        ];
    }

    protected function actions(Actions $actions): Actions
    {
        return $actions->create(
            [
                Action::make('edit', __('Sửa'), 'fas fa-edit')->modal(Base::class),
                Action::make('view', __('View'), 'fas fa-edit')->modal(Base::class),
                Action::make('delete', __('Xoá'), 'fas fa-trash-alt')->confirm(function ($data) {
                    return [
                        'message' => __('Bạn cho chắc muốn xoá hợp đồng?'),
                        'params' => $data, 'nameMethod' => 'delete',
                    ];
                }),
                Action::make('updateStatus', __('Mở khoá'), 'fas fa-trash-alt')->confirm(function ($data) {
                    return [
                        'message' => __('Bỏ khoá bài viết'),
                        'params' => $data, 'nameMethod' => 'put',
                    ];
                }),
            ]
        );
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make(),
            \Future\Table\Future\Components\Headers\Actions\Action::make('create', __('Tạo mới bài viết'))
                ->modal('create', Base::class),
        ];
    }

    protected function widgets(): array
    {
        $countPost = Widget::make('Tổng số bài viết: 0', '')
            ->callback(function ($widget) {
                $count = $this->model::query()
                    ->count();
                $widget->title = "Tổng số bài viết: " . $count;
                //$widget->setIcon('fa fa-contract');
                $widget->setCol(['md' => 6, 'xl' => 4]);
            });

        return [
            $countPost,
        ];
    }
}
