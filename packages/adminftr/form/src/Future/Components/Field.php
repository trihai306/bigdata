<?php

namespace Future\Form\Future\Components;

class Field
{
    public string $name;

    public bool $isRequired = false;

    public string $classes = '';

    public array $StyleAttributes = [];

    public string $rule = '';

    public mixed $defaultValue = null;

    public string $label = '';

    public bool $reactive = false;

    public array $messages = [];

    public string $helpText = '';

    public bool $canHide = false;

    public array $col = [];

    public string $placeholder = '';

    public ?string $url;

    public $afterStateUpdated = null;

    public function __construct(string $name, ?string $url = null)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public static function make(string $name): self
    {
        return new static($name);
    }

    public function required(): self
    {
        $this->isRequired = true;

        return $this;
    }

    public function classes(string $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function addAttribute(string $name, string $value): self
    {
        $this->StyleAttributes[$name] = $value;

        return $this;
    }

    public function defaultValue(mixed $value): self
    {
        $this->defaultValue = $value;

        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function helpText(string $helpText): self
    {
        $this->helpText = $helpText;

        return $this;
    }

    public function getAttributes(): string
    {
        $StyleAttributes = '';
        foreach ($this->StyleAttributes as $name => $value) {
            $StyleAttributes .= " {$name}=\"{$value}\"";
        }

        return $StyleAttributes;
    }

    public function hide(callable $callback): self
    {
        if ($callback()) {
            $this->canHide = true;
        }

        return $this;
    }

    public function canUpdate($hide)
    {
        $currentRouteName = UrlHelper::getUrl();
        if (str_contains($currentRouteName, 'edit')) {
            $this->canHide = ! $hide;
        }

        return $this;
    }

    public function canStore($hide)
    {
        $currentRouteName = UrlHelper::getUrl();
        if (str_contains($currentRouteName, 'create')) {
            $this->canHide = ! $hide;
        }

        return $this;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getHelpText(): string
    {
        return $this->helpText;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function reactive()
    {
        $this->reactive = true;

        return $this;
    }

    public function afterStateUpdated(callable $callback)
    {
        $this->afterStateUpdated = $callback;

        return $this;
    }

    public function rules(string $rule = ''): self
    {
        $this->rule = $rule;

        return $this;
    }

    public function messages(array $messages): self
    {
        $this->messages = $messages;

        return $this;
    }
}
