<?php

namespace Future\Form\Future\Components;

class Form
{
    public $request;

    protected $inputs = [];

    public function schema(array $inputs)
    {
        $this->inputs = $inputs;

        return $this;
    }

    public function render()
    {
        return $this->inputs;
    }
}
