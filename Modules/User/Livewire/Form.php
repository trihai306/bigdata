<?php

namespace Modules\User\Livewire;

use App\Models\User;
use Modules\Core\Livewire\BaseForm;
use Modules\Core\Livewire\Forms\Fields\Select;
use Modules\Core\Livewire\Forms\Fields\TextInput;
use Modules\Core\Livewire\Forms\Layouts\Card;
use Modules\Core\Livewire\Forms\Layouts\Row;

class Form extends BaseForm
{
    protected $model = User::class;
    public function form(\Modules\Core\Livewire\Forms\Form $form)
    {
        return $form->schema([
            Card::make()->schema([
                Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                    TextInput::make('name')->required()->label('Tên')->placeholder('Name'),
                    TextInput::make('email')->required()->label('Email')->placeholder('Email'),
                    TextInput::make('password')->required()->password()->label('Mật khẩu')->placeholder('Password'),
                    Select::make('gender')->label('Giới tính')->options([
                        'male' => 'nam',
                        'female' => 'nữ',
                        'non-binary' => 'không nhị phân',
                        'genderqueer' => 'giới tính lập dị',
                        'transgender' => 'chuyển giới',
                        'genderfluid' => 'giới tính linh hoạt',
                        'agender' => 'không giới tính'
                    ])
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
