<?php

namespace Modules\DataSystem\Livewire;

use App\Models\User;
use Future\Table\Future\BaseTable;
use Future\Table\Future\Tables\Actions\Action;
use Future\Table\Future\Tables\Actions\Actions;
use Future\Table\Future\Tables\Columns\ImageColumn;
use Future\Table\Future\Tables\Columns\TextColumn;
use Future\Table\Future\Tables\FilterInput;
use Illuminate\Database\Eloquent\Model;
use Modules\DataSystem\app\Models\DataSystem;

class Table extends BaseTable
{
    protected string $model = DataSystem::class;

    protected function columns(): array
    {
        return [
            TextColumn::make('id', __('ID'))->searchable()->sortable(),
            TextColumn::make('date', __('Date'))->searchable()->sortable()->dateTime(),
            TextColumn::make('importer.name', __('Importer'))->searchable()->sortable(),
            TextColumn::make('exporter.name', __('Exporter'))->searchable()->sortable(),
            TextColumn::make('hs_code.code', __('HS Code'))->searchable()->sortable(),
            TextColumn::make('quantity', __('Quantity'))->searchable()->sortable(),
            TextColumn::make('unit', __('Unit'))->searchable()->sortable(),
            TextColumn::make('weight', __('Weight'))->searchable()->sortable(),
            TextColumn::make('weight_unit', __('Weight Unit'))->searchable()->sortable(),
            TextColumn::make('package_quantity', __('Package Quantity'))->searchable()->sortable(),
            TextColumn::make('unit_pkg', __('Unit Package'))->searchable()->sortable(),
            TextColumn::make('country', __('Country'))->searchable()->sortable(),
            TextColumn::make('company_transport.name', __('Company Transport'))->searchable()->sortable(),
            TextColumn::make('created_at', __('Created At'))->searchable()->sortable()->dateTime(),
            TextColumn::make('updated_at', __('Updated At'))->searchable()->sortable()->dateTime(),
        ];
    }

    protected function filters(): array
    {
        return [
            FilterInput::make('name'),
            FilterInput::make('phone'),
        ];
    }

    protected function actions(Actions $actions, Model $data = null)
    {
        return $actions->create([
            Action::make('edit', __('edit'), 'fas fa-edit')->setLink(route('admin.user.edit', $data->id)),
            Action::make('delete', __('delete'), 'fas fa-trash-alt')->setConfirm(function () use ($data) {
                return [
                    'message' => __('Are you sure you want to delete this user?'),
                    'id' => $data->id,
                    'nameMethod' => 'delete'
                ];
            }),
        ]);
    }

    protected function headerAction()
    {
        return [

        ];
    }
}
