<?php

namespace App\Future\UserResource;

use App\Models\User;
use Future\Form\Future\BaseForm;
use Future\Form\Future\Forms\Fields\DateInput;
use Future\Form\Future\Forms\Fields\Select;
use Future\Form\Future\Forms\Fields\TextArea;
use Future\Form\Future\Forms\Fields\TextInput;
use Future\Form\Future\Forms\Layouts\Card;
use Future\Form\Future\Forms\Layouts\Col;
use Future\Form\Future\Forms\Layouts\Row;


class Form extends BaseForm
{
    protected $model = User::class;

    public function form(\Future\Form\Future\Forms\Form $form)
    {
        return $form->schema([
            Row::make()->schema([
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                            TextInput::make('name')->required()->label('Tên')->placeholder('Name'),
                            TextInput::make('email')->required()->label('Email')->placeholder('Email'),
                            TextInput::make('password')->required()->password()->label('Mật khẩu')
                                ->placeholder('Password')->canStore(false),
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
                ])->col(6),
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                            TextInput::make('phone')->label('Số điện thoại')->placeholder('Phone'),
                            TextInput::make('facebook')->label('Facebook')->placeholder('Facebook'),
                            TextInput::make('twitter')->label('Twitter')->placeholder('Twitter'),
                            TextInput::make('instagram')->label('Instagram')->placeholder('Instagram'),
                            TextInput::make('linkedin')->label('Linkedin')->placeholder('Linkedin'),
                            TextInput::make('github')->label('Github')->placeholder('Github'),
                            TextInput::make('website')->label('Website')->placeholder('Website'),
                        ])
                    ])
                ])->col(6)
            ]),
        ])->createRules([
            'data.name' => 'required',
            'data.email' => 'required|email',
            'data.password' => 'required',
            'data.address' => 'required'
        ])->editRules([
            'data.name' => 'required',
            'data.email' => 'required|email',
            'data.address' => 'required'
        ]);
    }


}
