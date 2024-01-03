<?php

namespace Modules\User\Livewire;

use App\Models\User;
use Modules\Core\Livewire\BaseForm;
use Modules\Core\Livewire\Forms\Fields\Select;
use Modules\Core\Livewire\Forms\Fields\TextInput;
use Modules\Core\Livewire\Forms\Layouts\Card;
use Modules\Core\Livewire\Forms\Layouts\Row;
use Spatie\Permission\Models\Role;

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
                    TextInput::make('password')->password()->label('Mật khẩu')->placeholder('Password'),
                    Select::make('gender')->label('Giới tính')->options([
                        'male' => 'nam',
                        'female' => 'nữ',
                        'transgender' => 'chuyển giới',
                        'genderfluid' => 'giới tính linh hoạt',
                        'agender' => 'không giới tính'
                    ]),
                    Select::make('role_id')->label('Vai trò')->modelData(Role::class, function ($role) {
                        return [$role->id => $role->name];
                    }),
                ])
            ])
        ]);
    }

    public function rules()
    {
        if ($this->id) {
            return [
                'data.name' => 'required',
                'data.email' => 'required|email'
            ];
        }
        return [
            'data.name' => 'required',
            'data.email' => 'required|email',
            'data.password' => 'required|min:6'
        ];
    }
}
