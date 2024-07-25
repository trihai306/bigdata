<?php

namespace App\Future\ContractResource;

use App\Future\ContractResource\Modal\Form;
use App\Models\Contract;
use App\Models\User;
use Future\Table\Future\BaseTable;
use Future\Table\Future\Components\Actions\Action;
use Future\Table\Future\Components\Actions\Actions;
use Future\Table\Future\Components\Columns\TextColumn;
use Future\Table\Future\Components\FilterInput;
use Future\Table\Future\Components\Filters\DateFilter;
use Future\Table\Future\Components\Filters\SelectFilter;
use Future\Table\Future\Components\Filters\TextFilter;
use Future\Table\Future\Components\Headers\Actions\ResetAction;
use Future\Widgets\Future\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class Table extends BaseTable
{
    protected string $model = Contract::class;

    protected function query(): Builder
    {
        return parent::query()->with(["user", "post"]); // TODO: Change the autogenerated stub
    }

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            TextColumn::make('code', __('Mã HĐ'))->searchable()->sortable(),
            TextColumn::make('post.field', __('Lĩnh vực'))->badge(
                [],
                [
                    'leather_goods' => __('Hàng đã hoá'),
                    'clothing' => __('Quần áo'),
                    'all' => __('Tất cả'),
                ]
            ),
            TextColumn::make('created_at', __('Ngày tạo'))->sortable(),
            TextColumn::make('id_user_b', __('Người tạo'))->hide(),
            TextColumn::make('post_id', __('Người tạo'))->hide(),
            TextColumn::make('user.name', __('Người tạo')),
            TextColumn::make('user.phone', __('SĐT'))->isRelation(),
            TextColumn::make('status', __('Trạng thái'))->badge(
                [
                    'accepted' => 'success',
                    'pending' => 'warning',
                    'returned' => 'danger',
                    'cancel' => 'danger',
                    'failed_to_pick' => 'danger',
                ],
                [
                    'accepted' => __('Hoàn Thành'),
                    'pending' => __('Đợi khiếu nại'),
                    'returned' => __('Hoàn lại tiền'),
                    'cancel' => __('Huỷ'),
                ]
            )
        ];
    }

    protected function filters(): array
    {
        return [
            SelectFilter::make('status', __('Trạng thái'))->options([
                ['id' => 'accepted', 'label' => 'Hoàn Thành'],
                ['id' => 'pending', 'label' => 'Đợi khiếu nại'],
                ['id' => 'returned', 'label' => 'Hoàn lại tiền'],
                ['id' => 'cancel', 'label' => 'Huỷ'],
            ]),
            DateFilter::make('created_at', __('Ngày tạo')),
        ];
    }

    protected function actions(Actions $actions): Actions
    {
        return $actions->create(
            [
                Action::make('view', __('View'), 'fas fa-edit')->link(function ($data) {
                    return route('admin.contracts.edit', $data->id);
                }),
                Action::make('delete', __('Xoá'), 'fas fa-trash-alt')->confirm(function ($data) {
                    return [
                        'message' => __('Bạn cho chắc muốn xoá hợp đồng?'),
                        'params' => $data, 'nameMethod' => 'delete',
                    ];
                }),
            ]
        );
    }

    protected function headerActions(): array
    {
        return [
            ResetAction::make()
        ];
    }

    protected function widgets(): array
    {
        $count = $this->model::query()->count();

        $widgetCountPermission = Widget::make($count.' Hợp đồng', '', 'fa fa-key');
        $widgetCountPermission->setColor('green');
        $widgetCountPermission->setCol(['md' => 5, 'xl' => 4]);

        $countContract = Widget::make('Tổng số hợp đồng: 0', '')
            ->callback(function ($widget) {
                $count = $this->model::query()
                    ->count();
                $widget->title = "Tổng số hợp đồng: " . $count;
                $widget->setIcon('fa-solid fa-file-contract');
                $widget->setCol(['md' => 6, 'xl' => 4]);
            });

        $countAccepted = Widget::make('Hơp đồng đã hoàn thành: 0', '')
            ->callback(function ($widget) {
                $count = $this->model::query()
                    ->where('status', 'accepted')
                    ->count();
                $widget->title = "Hơp đồng đã hoàn thành: " . $count;
                $widget->setIcon('fa-solid fa-file-contract');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('green');
            });

        $countCancel = Widget::make('Hơp đồng bị huỷ: 0', '')
            ->callback(function ($widget) {
                $count = $this->model::query()
                    ->where('status', 'cancel')
                    ->count();
                $widget->title = "Hơp đồng bị huỷ: " . $count;
                $widget->setIcon('fa-solid fa-file-contract');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('red');
            });

        $sumMoneyNotPay = Widget::make('Tổng tiền không thanh toán: 0', '')
            ->callback(function ($widget) {
                $count = $this->model::query()
                    ->where('status', 'cancel')
                    ->count();
                $widget->title = "Tổng tiền không thanh toán: " . $count;
                $widget->setIcon('fa-solid fa-money-bill-wave');
                $widget->setCol(['md' => 6, 'xl' => 4]);
                $widget->setColor('red');
            });

        return [
            $countContract,
            $countCancel,
            $countAccepted,
            $sumMoneyNotPay
        ];
    }
}