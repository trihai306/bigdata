<?php

namespace App\Future\UserResource\Modal;

use App\Models\User;
use Adminftr\Form\Future\Components\Fields\TextInput;
use Adminftr\Form\Future\Components\Layouts\Row;
use Adminftr\Form\Future\BaseModal;

class ChangePassword extends BaseModal
{
    protected $model = User::class;

    public function form(\Adminftr\Form\Future\Components\Form $form)
    {
        return $form->schema([
            Row::make($sm = 12, $md = 12, $lg = 12)->schema([
                TextInput::make('password')->required()->password()->label('Mật khẩu')->placeholder('Password'),
            ]),
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
