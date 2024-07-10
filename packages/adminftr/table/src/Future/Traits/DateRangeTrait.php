<?php

namespace Future\Table\Future\Traits;

use Carbon\Carbon;
use Livewire\Attributes\Url;

trait DateRangeTrait
{
    /**
     * The selected rows.
     *
     * @var array
     */
    #[Url(as: 'd')]
    public $dateRangeFilter = [];

    public function resetFiltersDate()
    {
        foreach ($this->dateRangeFilter as $column => $value) {
            $this->dateRangeFilter[$column] = '';
        }
    }

    public function DateRangeFiler($query)
    {
        foreach ($this->dateRangeFilter as $column => $value) {
            if (! empty($value)) {
                $dateArray = explode(" to ", $this->dateRangeFilter[$column]);
                $startDate = $dateArray[0];
                if (isset($dateArray[1])) {
                    $query->whereBetween($column, [$startDate, $dateArray[1]]);
                } else {
                    $query->whereDate($column ,$startDate);
                }
            }
        }
        return $query;
    }
}
