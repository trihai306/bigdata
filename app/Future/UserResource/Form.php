<?php

namespace App\Future\UserResource;

use App\Models\User;
use Future\Form\Future\BaseForm;
use Future\Form\Future\Forms\Fields\DateInput;
use Future\Form\Future\Forms\Fields\Select;
use Future\Form\Future\Forms\Fields\TextArea;
use Future\Form\Future\Forms\Fields\TextInput;
use Future\Form\Future\Forms\Layouts\Card;
use Future\Form\Future\Forms\Layouts\Row;


class Form extends BaseForm
{
    protected $model = User::class;
    public function form(\Future\Form\Future\Forms\Form $form)
    {
        return $form->schema([
            Card::make()->schema([
                Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                    TextInput::make('name')->required()->label('Tên')->placeholder('Name'),
                    TextInput::make('email')->required()->label('Email')->placeholder('Email'),
                    TextInput::make('password')->required()->password()->label('Mật khẩu')->placeholder('Password'),
                    TextArea::make('address')->label('Địa chỉ')->placeholder('Address'),
                    Select::make('gender')->label('Giới tính')->options([
                        'male' => 'nam',
                        'female' => 'nữ',
                        'non-binary' => 'không nhị phân',
                        'genderqueer' => 'giới tính lập dị',
                        'transgender' => 'chuyển giới',
                        'genderfluid' => 'giới tính linh hoạt',
                        'agender' => 'không giới tính'
                    ]),
                    DateInput::make('birthday')->label('Ngày sinh'),
                ])
            ])
        ]);
    }

    public function rules()
    {
        return [
            'data.name' => 'required',
            'data.email' => 'required|email|unique:users,email',
            'data.password' => 'required',
        ];
    }
}
