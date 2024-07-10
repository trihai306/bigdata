<?php

namespace Future\Table\Future;

use Future\Table\Future\Traits\Actions;
use Future\Table\Future\Traits\Can;
use Future\Table\Future\Traits\Columns;
use Future\Table\Future\Traits\ColumnVisibilityTrait;
use Future\Table\Future\Traits\DateRangeTrait;
use Future\Table\Future\Traits\FilterColumnsTrait;
use Future\Table\Future\Traits\Functions;
use Future\Table\Future\Traits\PaginationTrait;
use Future\Table\Future\Traits\SearchTrait;
use Future\Table\Future\Traits\SelectTrait;
use Future\Table\Future\Traits\SortTrait;
use Future\Table\Future\Traits\WidgetsTrait;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

abstract class BaseTable extends Component
{
    use Actions, Can, Columns, ColumnVisibilityTrait, DateRangeTrait,FilterColumnsTrait, Functions,
        PaginationTrait, SearchTrait, SelectTrait, SortTrait, WidgetsTrait, WithFileUploads;

    public array $forms = [];

    public string $title;

    protected string $view = 'future::base-table';

    protected array $select = [];

    protected array $with = [];

    protected string $model;

    public function resetTable(): void
    {
        $this->resetFilters();
        $this->resetPage();
        $this->resetFiltersDate();
        $this->resetFiltersSelect();
    }

    public function submitFilter()
    {
        $this->render();
    }

    #[On('refreshTable')]
    public function render()
    {
        $actions = $this->getActions();
        $actions = $actions->actions;
        $data = $this->applyTableQuery()->fastPaginate($this->perPage, pageName: 'page')->onEachSide(1);
        $this->dispatch('reset-select');

        return view($this->view, [
            'columns' => $this->defineColumns(),
            'actions' => $actions,
            'headerActions' => $this->headerActions(),
            'InputFilters' => $this->defineFilters(),
            'data' => $data,
            'bulkActions' => $this->bulkActions(),
        ]);
    }

    protected function applyTableQuery(): Builder
    {
        $query = $this->query();
        if (! empty(array_filter($this->filters))) {
            $query = $this->applyFilters();
        }
        if (! empty(array_filter($this->selectedRows))) {
            $query = $this->SelectedRows($query);
        }
        if (! empty(array_filter($this->dateRangeFilter))) {
            $query = $this->DateRangeFiler($query);
        }

        if ($this->search !== '') {
            $query = $this->applySearch($query);
        }
        if ($this->sortColumn && $this->sortDirection) {
            $query = $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return $this->afterQuery($query);
    }

    protected function query(): Builder
    {
        $select = array_merge($this->select, $this->getNameColumns());
        $relations = $this->getRelationColumns();
        $with = array_map(function ($relation) {
            return $relation['relation'];
        }, $relations);
        $with = array_merge($with, $this->with);

        $model = $this->model::query()->select($select);

        if (! empty($with)) {
            $model->with($with);
        }

        return $model;
    }

    protected function afterQuery($query): Builder
    {
        return $query;
    }

    public function boot()
    {
        $this->forms = $this->actions(new Components\Actions\Actions())->forms();

        $headerForms = collect($this->headerActions())
            ->filter(function ($headerAction) {
                return isset($headerAction->modal) && $headerAction->modal;
            })
            ->map(function ($headerAction) {
                return [
                    'form' => $headerAction->form,
                    'name' => $headerAction->name,
                    'label' => $headerAction->label,
                ];
            })
            ->toArray();

        $this->forms = array_merge($this->forms, $headerForms);
    }

    abstract protected function filters(): array;
}
