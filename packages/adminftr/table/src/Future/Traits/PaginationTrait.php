<?php

namespace Future\Table\Future\Traits;

use Livewire\Attributes\Url;
use Livewire\WithPagination;

/**
 * Trait PaginationTrait
 *
 * This trait is used to handle pagination in Livewire components.
 */
trait PaginationTrait
{
    use WithPagination;

    /**
     * The number of items to be displayed per page.
     */
    #[Url]
    public int $perPage = 10;

    /**
     * The available options for items per page.
     */
    public array $pages = [10, 25, 50, 100, 1000, 10000];

    public function updatingPerPage()
    {
        $this->resetPage();
    }
}
