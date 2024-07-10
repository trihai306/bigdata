<?php

namespace Future\Table\Future\Components\Actions;

use Illuminate\Database\Eloquent\Model;

class Action
{
    // Properties
    public string $name;

    public string $label;

    public ?string $icon;

    public ?int $id;

    public $data;

    public ?string $link = null;

    public ?string $form = null;

    public ?string $tooltip = null;

    public bool $disabled = false;

    public array $SweetAlert = [];

    public bool $modal = false;

    public ?string $color = 'text-dark';

    public ?string $size = '';

    private array $postSetDataQueue = [];

    public function __construct(string $name, string $label, ?string $icon = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
    }

    public static function make(string $name, string $label, ?string $icon = null, ?Model $data = null): self
    {
        return new self($name, $label, $icon, $data);
    }

    public function id(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function size(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function data(Model $data)
    {
        $this->data = $data;
        $this->id = $data->id;
        while (! empty($this->postSetDataQueue)) {
            $function = array_shift($this->postSetDataQueue);
            $function($this);
        }

        return $this;
    }

    public function modal(string $form): self
    {
        $this->form = $form;
        $this->link = null;
        $this->modal = true;

        return $this;
    }

    public function sweetAlert(string $eventName, array $options = []): self
    {
        $this->SweetAlert = [
            'eventName' => $eventName,
            'options' => $options,
        ];

        return $this;
    }

    public function confirm(array|callable $options): self
    {
        if ($this->data === null) {
            if (is_callable($options)) {
                $this->postSetDataQueue[] = function ($self) use ($options) {
                    $self->confirm($options);
                };

                return $this;
            }
        }
        if (is_callable($options)) {
            $options = $options($this->data);
        }
        $this->sweetAlert = [
            'eventName' => 'swalConfirm',
            'options' => $options,
        ];

        return $this;
    }

    public function label(string|callable $label): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function ($self) use ($label) {
                $self->label($label);
            };

            return $this;
        }
        if (is_callable($label)) {
            $label = $label();
        }
        $this->label = $label;

        return $this;
    }

    public function icon(string|callable $icon): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function ($self) use ($icon) {
                $self->icon($icon);
            };

            return $this;
        }
        if (is_callable($icon)) {
            $icon = $icon();
        }
        $this->icon = $icon;

        return $this;
    }

    public function disabled(bool|callable $disabled): self
    {
        if (is_callable($disabled)) {
            $disabled = $disabled();
        }
        $this->disabled = $disabled;

        return $this;
    }

    public function link(string|callable $link): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function ($self) use ($link) {
                $self->link($link);
            };

            return $this;
        }
        if (is_callable($link)) {
            $link = $link($this->data);
        }
        $this->modal = false;
        $this->link = $link;

        return $this;
    }

    public function tooltip(string|callable $tooltip): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function ($self) use ($tooltip) {
                $self->tooltip($tooltip);
            };

            return $this;
        }
        if (is_callable($tooltip)) {
            $tooltip = $tooltip();
        }
        $this->tooltip = $tooltip;

        return $this;
    }

    public function name(string|callable $name): self
    {
        if (is_callable($name)) {
            $name = $name();
        }
        $this->name = $name;

        return $this;
    }

    public function render()
    {
        return view('future::base.actions.action', ['action' => $this]);
    }
}
