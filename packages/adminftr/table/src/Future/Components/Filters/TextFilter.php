<?php

namespace Future\Table\Future\Components\Filters;

class TextFilter extends Filter
{
    public string $placeholder = '';

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function render()
    {
        $name = $this->name;
        $label = $this->label;
        $placeholder = $this->placeholder;

        return view('future::base.filters.text-filter', compact('name', 'label', 'placeholder'));
    }
}
