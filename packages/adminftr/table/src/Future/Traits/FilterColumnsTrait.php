<?php

namespace Future\Table\Future\Traits;

use Livewire\Attributes\Url;

trait FilterColumnsTrait
{
    #[Url(as: 'f')]
    public $filters = [];

    public function resetFilters()
    {
        foreach ($this->filters as $column => $value) {
            $this->filters[$column] = '';
        }
    }

    protected function applyFilters()
    {
        $query = $this->query();
        foreach ($this->filters as $column => $value) {
            if (! empty($value)) {
                $query->where($column, $value);
            }
        }

        return $query;
    }
}
