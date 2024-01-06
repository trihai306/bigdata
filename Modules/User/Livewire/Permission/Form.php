<?php

namespace Modules\User\Livewire\Permission;



use Future\Form\Livewire\BaseForm;
use Future\Form\Livewire\Forms\Fields\TextInput;
use Future\Form\Livewire\Forms\Layouts\Card;
use Future\Form\Livewire\Forms\Layouts\Row;
use Spatie\Permission\Models\Permission;

class Form extends BaseForm
{
    public $model = Permission::class;
    public function form(\Future\Form\Livewire\Forms\Form $form)
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
