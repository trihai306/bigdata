<?php

namespace Modules\Core\Livewire\Tables\Traits;

use Livewire\Attributes\Url;

trait FilterColumnsTrait {
//    #[Url]
    public $filters = [];

    public function canFilter($can=true)
    {
      return $can;
    }
    public function updateFilters($column, $value)
    {
        $this->filters[$column] = $value;
    }

    public function resetFilters()
    {
        foreach ($this->filters as $column => $value) {
            $this->filters[$column] = '';
        }
    }

    public function applyFilters()
    {
        $query = $this->query();
        foreach ($this->filters as $column => $value) {
            if (!empty($value)) {
                $query->where($column, 'like', '%' . $value . '%');
            }
        }

        return $query;
    }
}
