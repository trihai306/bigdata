<?php

namespace Adminftr\Table\Future\Traits;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;

/**
 * Trait SearchTrait
 *
 * This trait is used to handle search functionality in Livewire components.
 */
trait SearchTrait
{
    /**
     * The search query.
     *
     * @var string
     */
    #[Session]
    #[Url(as: 's')]
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Apply the search query to the given query.
     *
     * @param  Builder  $query
     * @return Builder
     */
    protected function applySearch($query)
    {

        $searchColumns = $this->getSearchableNonRelationColumns();
        $relationColumns = $this->getSearchableRelationColumns();
        $query->where(function ($subQuery) use ($searchColumns, $relationColumns) {
            foreach ($searchColumns as $column) {
                $subQuery->orWhere($column, 'like', '%'.$this->search);
            }
            if (! empty($relationColumns)) {
                foreach ($relationColumns as $relationColumn) {
                    $subQuery->orWhereHas($relationColumn['relation'], function ($query) use ($relationColumn) {
                        $query->where($relationColumn['column'], 'like', '%'.$this->search);
                    });
                }
            }
        });

        return $query;
    }
}
