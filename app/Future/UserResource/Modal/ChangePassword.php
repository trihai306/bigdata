<?php

namespace App\Future\UserResource\Modal;

use App\Models\User;
use Future\Form\Future\Forms\Fields\TextInput;
use Future\Form\Future\Forms\Layouts\Row;
use Future\Form\Future\ModalForm;


class ChangePassword extends ModalForm
{
    protected $model = User::class;
    public function form(\Future\Form\Future\Forms\Form $form)
    {
        return $form->schema([
            Row::make($sm = 12, $md = 12, $lg = 12)->schema([
                TextInput::make('password')->required()->password()->label('Mật khẩu')->placeholder('Password'),
            ])
        ]);
    }

    protected function beforeSave($data)
    {
        $data['password'] = bcrypt($data['password']);
        return $data;
    }
    public function rules()
    {
        return [
            'data.password' => 'required',
        ];
    }
}
