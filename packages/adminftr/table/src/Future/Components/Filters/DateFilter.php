<?php

namespace Future\Table\Future\Components\Filters;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DateFilter extends Filter
{
    public string $placeholder = '';

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        $name = $this->name;
        $label = $this->label;
        $placeholder = $this->placeholder;

        return view('future::base.filters.date-filter', compact('name', 'label', 'placeholder'));
    }
}
