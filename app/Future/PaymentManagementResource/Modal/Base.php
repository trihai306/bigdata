<?php

namespace App\Future\PaymentManagementResource\Modal;

use App\Models\Contract;
use Adminftr\Form\Future\Components\Fields\TextInput;
use Adminftr\Form\Future\Components\Layouts\Row;
use Adminftr\Form\Future\BaseModal;

class Base extends BaseModal
{
    public $model = Contract::class;

    public function form(\Adminftr\Form\Future\Components\Form $form): \Adminftr\Form\Future\Components\Form
    {
        return $form->schema([
            Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                TextInput::make('total_amount')->label('Số tiền thanh toán')->disabled()->placeholder('Mã hợp đồng'),
                TextInput::make('user.name')->label('Họ và tên khách hàng')->disabled()->placeholder('Họ và tên khách hàng'),
                TextInput::make('deposit_amount')->label('Nội dung thanh toán')->disabled()->placeholder('Số tiền đặt cược'),
                TextInput::make('code')->label('Mã hợp đồng')->disabled()->placeholder('Mã hợp đồng'),
            ]),
        ]);
    }

    public function rules()
    {
        return [
            'data.name' => 'required',
            'data.guard_name' => 'required',
        ];
    }
}
