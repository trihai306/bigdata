<?php

namespace Adminftr\Table\Future;

use Adminftr\Table\Future\Traits\Actions;
use Adminftr\Table\Future\Traits\Can;
use Adminftr\Table\Future\Traits\Columns;
use Adminftr\Table\Future\Traits\ColumnVisibilityTrait;
use Adminftr\Table\Future\Traits\DateRangeTrait;
use Adminftr\Table\Future\Traits\FilterColumnsTrait;
use Adminftr\Table\Future\Traits\Functions;
use Adminftr\Table\Future\Traits\PaginationTrait;
use Adminftr\Table\Future\Traits\SearchTrait;
use Adminftr\Table\Future\Traits\SelectTrait;
use Adminftr\Table\Future\Traits\SortTrait;
use Adminftr\Table\Future\Traits\WidgetsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

abstract class BaseTable extends Component
{
    use Actions,
        Columns,
        ColumnVisibilityTrait,
        DateRangeTrait,
        FilterColumnsTrait,
        Functions,
        can,
        PaginationTrait,
        SearchTrait,
        SelectTrait,
        SortTrait,
        WidgetsTrait,
        WithFileUploads;

    public array $forms = [];

    public string $title;

    public string $description;

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
        $data = $this->applyTableQuery()->fastPaginate($this->perPage, pageName: 'page')->onEachSide(1);
        $this->dispatch('reset-select');

        return view($this->view, [
            'data' => $data,
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

        $cacheKey = 'table_query_cache_'.class_basename($this->model);
        if (config('future.cache.enabled')) {
            return Cache::remember($cacheKey, 300, function () use ($select, $with) {
                return $this->executeQuery($select, $with);
            });
        } else {
            return $this->executeQuery($select, $with);
        }
    }

    private function executeQuery($select, $with): Builder
    {
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
        $this->forms = $this->actions(new Components\Actions\Actions)->forms();

        $headerForms = collect($this->headerActions())
            ->filter(function ($headerAction) {
                return isset($headerAction->modal) && $headerAction->modal;
            })
            ->map(function ($headerAction) {
                return [
                    'form' => $headerAction->form,
                    'name' => $headerAction->name,
                    'label' => $headerAction->label,
                    'type' => $headerAction->type,
                ];
            })
            ->toArray();
        $this->forms = array_merge($this->forms, $headerForms);
    }

    abstract protected function filters(): array;
}
