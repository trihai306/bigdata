<?php

namespace Future\Table\Future\Components\Filters;

class Filter
{
    protected ?string $name;

    protected ?string $label;

    protected ?string $type;

    public function __construct(string $name, string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public static function make(string $name, string $label)
    {
        return new static($name, $label);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->label;
    }
}
