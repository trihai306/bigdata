<?php

namespace App\Future\BillOfLadingResource\Modal;

use App\Models\Contract;
use Adminftr\Form\Future\Components\Fields\TextInput;
use Adminftr\Form\Future\Components\Layouts\Row;
use Adminftr\Form\Future\BaseModal;

class Base extends BaseModal
{
    public  $model = Contract::class;

    public function form(\Adminftr\Form\Future\Components\Form $form): \Adminftr\Form\Future\Components\Form
    {
        return $form->schema([
            Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                TextInput::make('user_id')->required()->label('Tên')->placeholder('Name'),
                TextInput::make('description')->required()->label('Mô tả')->placeholder('Mô tả'),
                TextInput::make('total_amount')->required()->label('Tổng cộng')->placeholder('Tổng cổng'),
                TextInput::make('deposit_amount')->required()->label('Số tiền đặt cược')->placeholder('Số tiền đặt cược'),
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
