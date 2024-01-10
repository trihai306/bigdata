<?php

namespace Future\Form\Future\Forms;

class Field
{
    protected $name;
    protected $isRequired = false;
    protected $classes = '';
    protected $StyleAttributes = [];
    protected $rules = [];
    protected $defaultValue = null;
    protected $label = '';
    protected $helpText = '';
    protected $canHide = false;


    public static function make(string $name)
    {
        $instance = new static;
        $instance->name = $name;
        return $instance;
    }

    public function required()
    {
        $this->isRequired = true;
        return $this;
    }

    public function classes(string $classes)
    {
        $this->classes = $classes;
        return $this;
    }

    public function addAttribute(string $name, string $value)
    {
        $this->StyleAttributes[$name] = $value;
        return $this;
    }

    public function addRules(array $rules)
    {
        $this->rules = array_merge($this->rules, $rules);
        return $this;
    }

    public function defaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }

    public function helpText(string $helpText)
    {
        $this->helpText = $helpText;
        return $this;
    }

    public function getAttributes()
    {
        $StyleAttributes = '';
        foreach ($this->StyleAttributes as $name => $value) {
            $StyleAttributes .= " {$name}=\"{$value}\"";
        }
        return $StyleAttributes;
    }

    public function hide(callable $callback)
    {
        if ($callback()) {
            $this->canHide = true;
        }
        return $this;
    }

    public function canEdit(callable $callback)
    {
        if ($callback()) {
            $this->canHide = false;
        }
        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getHelpText()
    {
        return $this->helpText;
    }

    public function getName()
    {
        return $this->name;
    }
}
