<?php

namespace Future\Table\Future\Traits;

trait WidgetsTrait
{
    protected function defineWidgets()
    {
        return $this->widgets();
    }

    protected function widgets(){
        return [];
    }
}
