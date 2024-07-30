<?php

namespace Adminftr\Table\Future\Components\Filters;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SelectFilter extends Filter
{
    public array $options = [];

    public bool $multiple = false;

    public string $valueField = 'id';

    public string $labelField = 'label';

    public int $maxOptions = 10;

    public bool $liveSearch = false;

    public string $keySearch = 'name';

    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function maxOptions(int $maxOptions)
    {
        $this->maxOptions = $maxOptions;

        return $this;
    }

    public function valueField(string $valueField)
    {
        $this->valueField = $valueField;

        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function keySearch(string $keySearch)
    {
        $this->keySearch = $keySearch;

        return $this;
    }

    public function multiple(bool $multiple = true)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        $name = $this->name;
        $label = $this->label;
        $options = $this->options;

        return view('future::base.filters.select-filter', [
            'name' => $name,
            'label' => $label,
            'options' => $options,
            'maxOptions' => $this->maxOptions,
            'multiple' => $this->multiple,
            'valueField' => $this->valueField,
            'labelField' => $this->labelField,
            //            'liveSearch' => $this->liveSearch,
        ]);
    }
}
