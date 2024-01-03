<?php

namespace Modules\Core\Livewire\Forms;

use Livewire\Component;

class Form
{
    protected $inputs = [];


    public function __construct()
    {
    }

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
