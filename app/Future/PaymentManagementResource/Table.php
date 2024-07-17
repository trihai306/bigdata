<?php

namespace App\Future\PaymentManagementResource;

use App\Future\PaymentManagementResource\Modal\Form;
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
            TextColumn::make('id_user_b', __('SĐT')),
            TextColumn::make('total_amount', __('Giá ( vnđ )')),
            TextColumn::make('estimated_delivery_date', __('Ngày TT'))->sortable(),
            TextColumn::make('user.name', __('Người TT'))->sortable(),
            TextColumn::make('status', __('Trạng thái'))->badge(
                [
                    'accepted' => 'success',
                    'pending' => 'warning',
                    'returned' => 'danger',
                    'cancel' => 'danger',
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
            TextFilter::make('code', __('Mã HĐ')),
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
                Action::make('updateStatus', __('Xác nhận thanh toán'), 'fas fa-edit')->modal(Form::class),
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
            ResetAction::make(),
            \Future\Table\Future\Components\Headers\Actions\Action::make('create', __('Tạo mới hợp đồng'))
                ->modal('create', Form::class),
        ];
    }

    protected function widgets(): array
    {
        return [

        ];
    }
}
