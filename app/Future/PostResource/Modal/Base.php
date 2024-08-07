<?php

namespace App\Future\PostResource\Modal;

use App\Models\Contract;
use Adminftr\Form\Future\Components\Fields\Select;
use Adminftr\Form\Future\Components\Fields\TextArea;
use Adminftr\Form\Future\Components\Fields\TextInput;
use Adminftr\Form\Future\Components\Layouts\Row;
use Adminftr\Form\Future\BaseModal;

class Base extends BaseModal
{
    public $model = Contract::class;

    public function form(\Adminftr\Form\Future\Components\Form $form)
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
