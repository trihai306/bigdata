<?php

namespace App\Future\PostResource\Modal;

use App\Models\Contract;
use Future\Form\Future\Components\Fields\Select;
use Future\Form\Future\Components\Fields\TextArea;
use Future\Form\Future\Components\Fields\TextInput;
use Future\Form\Future\Components\Layouts\Row;
use Future\Form\Future\ModalForm;

class Form extends ModalForm
{
    public $model = Contract::class;

    public function form(\Future\Form\Future\Components\Form $form)
    {
        return $form->schema([
            Row::make($sm = 12, $md = 6, $lg = 6)->schema([
                TextInput::make('title')->required()->label('Tiêu đề bài viết')->placeholder('Tiêu đề bài viết'),
                TextArea::make('content')->required()->label('Nội dung bài viết')->placeholder('Nội dung bài viết'),
            ]),
        ]);
    }

    public function rules()
    {
        return [
            'data.title' => 'required',
            'data.content' => 'required',
        ];
    }
}
