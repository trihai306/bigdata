<?php

namespace Future\Table\Future\Tables\Actions;

use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;

/**
 * Class Action
 *
 * This is a description for the class
 */
class Action
{
    // Properties
    public string $name;
    public string $label;
    public ?string $icon;
    public ?int $id;
    public Model $data;
    public ?string $link = null;
    public ?string $modalId=null; // new property
    public ?string $tooltip=null; // tooltip for the action
    public bool $disabled = false; // disables the action if true
    public array $SweetAlert = []; // new property

    /**
     * Constructor
     *
     * @param string $name
     * @param string $label
     * @param string|null $icon
     * @param int|null $id
     */
    public function __construct(string $name, string $label, ?string $icon = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Static constructor
     *
     * @param string $name
     * @param string $label
     * @param string|null $icon
     */
    public static function make(string $name, string $label, ?string $icon = null): self
    {
        return new self($name, $label, $icon);
    }


    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setData(Model $data): self {
        $this->data = $data;
        return $this;
    }


    /**
     * Set modal ID
     *
     * This is a description for this method
     *
     * @param string $modalId
     * @return $this
     */
    public function setModalId(string $modalId): self
    {
        $this->modalId = $modalId;
        return $this;
    }


    /**
     * Render action
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */

    public function setLivewireMethod(string $livewireMethod, ?string $livewireParameter = null): self
    {
        $this->livewireMethod = $livewireMethod;
        $this->livewireParameter = $livewireParameter;
        return $this;
    }

    /**
     * Dispatch a Livewire event to show a sweet alert
     *
     * @param string $eventName
     * @param array $options
     * @return $this
     */
    public function SweetAlert(string $eventName, array $options = []): self
    {
        $this->SweetAlert = [
            'eventName' => $eventName,
            'options' => $options
        ];
        return $this;
    }

    public function setConfirm(array|callable $options): self
    {
        if (is_callable($options)) {
            $options = $options();
        }

        $this->sweetAlert = [
            'eventName' => 'swalConfirm',
            'options' => $options
        ];

        return $this;
    }

    public function setLabel(string|callable $label): self
    {
        if (is_callable($label)) {
            $label = $label();
        }

        $this->label = $label;

        return $this;
    }

    public function setIcon(string|callable $icon): self
    {
        if (is_callable($icon)) {
            $icon = $icon();
        }

        $this->icon = $icon;

        return $this;
    }

    public function setDisabled(bool|callable $disabled): self
    {
        if (is_callable($disabled)) {
            $disabled = $disabled();
        }

        $this->disabled = $disabled;

        return $this;
    }

    public function setLink(string|callable $link): self
    {
        if (is_callable($link)) {
            $link = $link();
        }

        $this->link = $link;

        return $this;
    }

    public function setTooltip(string|callable $tooltip): self
    {
        if (is_callable($tooltip)) {
            $tooltip = $tooltip();
        }

        $this->tooltip = $tooltip;

        return $this;
    }

    public function setName(string|callable $name): self
    {
        if (is_callable($name)) {
            $name = $name();
        }

        $this->name = $name;

        return $this;
    }
    public function setRender(callable $renderFunction): self
    {
        $renderFunction($this);
        return $this;
    }
}
