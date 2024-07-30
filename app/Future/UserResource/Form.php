<?php

namespace App\Future\UserResource;

use App\Models\User;
use Adminftr\Form\Future\BaseForm;
use Adminftr\Form\Future\Components\Actions\Action;
use Adminftr\Form\Future\Components\Fields\DateInput;
use Adminftr\Form\Future\Components\Fields\Radio;
use Adminftr\Form\Future\Components\Fields\Select;
use Adminftr\Form\Future\Components\Fields\TextArea;
use Adminftr\Form\Future\Components\Fields\TextInput;
use Adminftr\Form\Future\Components\Layouts\Card;
use Adminftr\Form\Future\Components\Layouts\Col;
use Adminftr\Form\Future\Components\Layouts\Row;

class Form extends BaseForm
{
    protected $model = User::class;

    public function form(\Adminftr\Form\Future\Components\Form $form)
    {
        return $form->schema([
            Row::make()->schema([
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make(12, 6, 6)->schema([
                            TextInput::make('name')
                                ->label('Tên')
                                ->required()
                                ->placeholder('Name')->canUpdate(false),
                            TextInput::make('password')->required()->password()->label('Mật khẩu')
                                ->placeholder('Password')->canStore(true)->canUpdate(true),
                            TextInput::make('password_confirmation')->required()->password()->label('Xác nhận mật khẩu')
                                ->placeholder('Password confirmation')->canStore(false)->canUpdate(true),
                            DateInput::make('birthday')->label('Ngày sinh')->canUpdate(false),
                            Col::make()->schema([
                                TextArea::make('address')->label('Địa chỉ')->required()->placeholder('Address')->canUpdate(false),
                            ])->col(12),

                        ]),
                    ]),
                ])->sm(12)->md(6)->lg(8),
                Col::make()->schema([
                    Card::make()->schema([
                        Row::make()->schema([
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
                            )->required()->canUpdate(false),
                            Radio::make('status')->label('Trạng thái')->options([['id' => 'active', 'label' => 'Hoạt động'], ['id' => 'inactive', 'label' => 'Không hoạt động']])->required(),
                        ]),
                    ]),
                ])->sm(12)->md(6)->lg(4),
            ]),
        ]);
    }
}
