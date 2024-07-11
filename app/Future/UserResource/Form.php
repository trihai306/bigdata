<?php

namespace App\Future\UserResource;

use App\Models\User;
use Future\Form\Future\BaseForm;
use Future\Form\Future\Components\Actions\Action;
use Future\Form\Future\Components\Fields\DateInput;
use Future\Form\Future\Components\Fields\Radio;
use Future\Form\Future\Components\Fields\Select;
use Future\Form\Future\Components\Fields\TextArea;
use Future\Form\Future\Components\Fields\TextInput;
use Future\Form\Future\Components\Layouts\Card;
use Future\Form\Future\Components\Layouts\Col;
use Future\Form\Future\Components\Layouts\Row;
use Spatie\Permission\Models\Role;

class Form extends BaseForm
{
    protected $model = User::class;

    public function form(\Future\Form\Future\Components\Form $form)
    {
        return $form->schema([
            Row::make()->schema([
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make(12, 6, 6)->schema([
                            TextInput::make('name')
                                ->label('Tên')
                                ->required()
                                ->placeholder('Name'),
                            TextInput::make('email')->required()->label('Email')->placeholder('Email'),
                            TextInput::make('password')->required()->password()->label('Mật khẩu')
                                ->placeholder('Password')->canStore(false),
                            DateInput::make('birthday')->label('Ngày sinh'),
                            Col::make()->schema([
                                TextArea::make('address')->label('Địa chỉ')->required()->placeholder('Address'),
                            ])->col(12),

                        ]),
                    ]),
                ])->sm(12)->md(6)->lg(8),
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make()->schema([
                            Select::make('user.roles')->label('Vai trò')->required()->liveSearch(
                                function ($query) {
                                    return Role::where('name', 'like', '%'.$query.'%')->limit(20)->get();
                                }
                            )->multiple(),
                            Select::make('gender')->label('Giới tính')->options(
                                [
                                    ['id' => 'male', 'label' => 'nam'],
                                    ['id' => 'female', 'label' => 'nữ'],
                                    ['id' => 'non-binary', 'label' => 'không nhị phân'],
                                    ['id' => 'genderqueer', 'label' => 'giới tính lập dị'],
                                    ['id' => 'transgender', 'label' => 'chuyển giới'],
                                    ['id' => 'genderfluid', 'label' => 'giới tính linh hoạt'],
                                    ['id' => 'agender', 'label' => 'không giới tính'],
                                ]
                            )->required(),
                            Radio::make('status')->label('Trạng thái')->options([['id' => 'active', 'label' => 'Hoạt động'], ['id' => 'inactive', 'label' => 'Không hoạt động']])->required(),
                        ]),
                    ]),
                ])->sm(12)->md(6)->lg(4),
            ]),
        ]);
    }

    public function Actions()
    {
        return [
            Action::make('save', 'Lưu')->color('primary')->action(function ($state) {}),
            Action::make('saveAndClose', 'Lưu và đóng')->color('primary'),
            Action::make('cancel', 'Hủy')->color('danger'),
        ];
    }
}
