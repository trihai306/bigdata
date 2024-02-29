<?php

namespace App\Future\PermissionResource;

use Future\Form\Future\BaseForm;
use Future\Form\Future\Forms\Fields\TextInput;
use Future\Form\Future\Forms\Layouts\Card;
use Future\Form\Future\Forms\Layouts\Row;
use Spatie\Permission\Models\Permission;

class Form extends BaseForm
{
    public $model = Permission::class;
    public function form(\Future\Form\Future\Forms\Form $form)
    {
        return $form->schema([
           Card::make()->schema([
               Row::make($sm=12,$md=6,$lg=6)->schema([
                   TextInput::make('name')->required()->label('Tên')->placeholder('Name'),
                   TextInput::make('guard_name')->required()->label('Guard Name')->placeholder('Guard Name'),
               ])
           ])
        ]);
    }

    public function rules(){
        return [
            'data.name' => 'required',
            'data.guard_name' => 'required',
        ];
    }
}
