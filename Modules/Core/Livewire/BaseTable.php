<?php

namespace Modules\Core\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Core\Livewire\Tables\Actions\Actions;
use Modules\Core\Livewire\Tables\Traits\Can;
use Modules\Core\Livewire\Tables\Traits\ColumnVisibilityTrait;
use Modules\Core\Livewire\Tables\Traits\Exportable;
use Modules\Core\Livewire\Tables\Traits\FilterColumnsTrait;
use Modules\Core\Livewire\Tables\Traits\Functions;
use Modules\Core\Livewire\Tables\Traits\Importable;
use Modules\Core\Livewire\Tables\Traits\PaginationTrait;
use Modules\Core\Livewire\Tables\Traits\SearchTrait;
use Modules\Core\Livewire\Tables\Traits\SelectTrait;
use Modules\Core\Livewire\Tables\Traits\SortTrait;


abstract class BaseTable extends Component
{
    use WithPagination, FilterColumnsTrait, PaginationTrait, ColumnVisibilityTrait, SortTrait, SearchTrait, SelectTrait, Exportable;
    use Functions,Importable,Can;
    use WithFileUploads;
    protected string $view = 'core::livewire.base-table';
    private $actions;
    protected array $select = [];
    protected string $model;
    public string $urlCreate = '';

    /**
     * Set the view for the component.
     *
     * @param string $view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function placeholder()
    {
        return view('core::livewire.placeholder');
    }

    /**
     * Set the model for the table.
     *
     * @param mixed $model
     * @return void
     */
    public function setModel(string $model) : void
    {
        $this->model = $model;
    }

    /**
     * Define the columns for the table.
     *
     * @return array
     */
    abstract protected function columns() : array;

    /**
     * Define the visibility of the columns.
     *
     * @return array
     */
    protected function defineColumns() : array
    {
        $columns = $this->columns();

        foreach ($columns as $column) {
            $column->visible = $this->columnVisibility[$column->name] ?? $column->visible;
        }

        return $columns;
    }


    protected function headerAction()
    {
        return [];
    }

    abstract protected function filters() : array;

    /**
     * Define the filters for the table.
     *
     * @return array
     */
    protected function defineFilters() : array
    {
        return $this->filters();
    }

    abstract protected function actions(Actions $actions, Model $data = null);

    /**
     * Define the actions for the table.
     *
     * @param $id
     * @return array
     */
    protected function defineActions(Model $data = null)
    {
        return $this->actions(new Actions(), $data)->render();
    }

    /**
     * Get the query for the table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @throws \Exception
     */
    protected function query()  : \Illuminate\Database\Eloquent\Builder
    {
        if (is_null($this->model)) {
            throw new \Exception("Model must be set for the query.");
        }
        if (empty($this->select)) {
            $this->select = ['*'];
        }
        $this->model::select($this->select);
        return $this->model::query();
    }

    protected function affterQuery($query) : \Illuminate\Database\Eloquent\Builder
    {
        return $query;
    }

    /**
     * Apply the table query, including search and sort.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyTableQuery()    : \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->query();
        // Implement search logic
        if (!empty(array_filter($this->filters))) {

            $query = $this->applyFilters();
        }
        if ($this->search !== '') {
            $query = $this->applySearch($query);
        }

        // Apply sorting
        if ($this->sortColumn && $this->sortDirection) {
            $query = $query->orderBy($this->sortColumn, $this->sortDirection);
        }
        $query = $this->affterQuery($query);
        return $query;
    }

    /**
     * Reset the table filters and page.
     *
     * @return void
     */
    public function resetTable() : void
    {
        $this->resetFilters();
        $this->resetPage();
    }

    /**
     * Render the table.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $data = $this->applyTableQuery()->paginate($this->perPage, pageName: 'page')->onEachSide(1);

        return view($this->view, [
            'columns' => $this->defineColumns(),
            'actions' => $this->actions,
            'Input_filters' => $this->defineFilters(),
            'data' => $data,
        ]);
    }


}
