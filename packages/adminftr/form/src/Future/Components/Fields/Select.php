<?php

namespace Future\Form\Future\Components\Fields;

use Closure;
use Future\Form\Future\Components\Field;
use Illuminate\Database\Eloquent\Model;

class Select extends Field
{
    public array $options = [];

    public bool $multiple = false;

    public string $valueField = 'id';

    public string $labelField = 'label';

    public int $maxOptions = 50;

    public bool $liveSearch = false;

    public string $keySearch = 'name';

    public Model $model;

    public int $limit = 50;

    public array $plugins = ['input_autogrow', 'remove_button', 'caret_position'];

    protected $callbackSearch;

    public function options(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function plugins($plugins)
    {
        $this->plugins = $plugins;

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

    public function liveSearch(?callable $callback = null)
    {
        $this->liveSearch = true;
        $this->plugins[] = 'virtual_scroll';
        if ($callback) {
            $this->callbackSearch = $callback;
        }

        return $this;
    }

    public function model(string $modelClass, ?Closure $transform = null)
    {
        $models = $modelClass::limit($this->limit)->get();
        if ($transform === null) {
            $transform = function ($model) {
                return [
                    $this->valueField => $model->id,
                    $this->labelField => $model->name,
                ];
            };
        }
        $this->model = new $modelClass;
        $this->options = $models->map($transform)->toArray();

        return $this;
    }

    public function limit(int $limit = 50)
    {
        $this->limit = $limit;

        return $this;
    }

    public function keySearch(string $keySearch)
    {
        $this->keySearch = $keySearch;

        return $this;
    }

    public function search($value)
    {
        if ($this->callbackSearch) {
            $this->options = call_user_func($this->callbackSearch, $value)->map(function ($model) {
                return [
                    $this->valueField => $model->id,
                    $this->labelField => $model->name,
                ];
            })->toArray();

            return $this;
        }
        $this->options = $this->model::where($this->keySearch, 'like', '%'.$value.'%')
            ->limit($this->limit)->get()->map(function ($model) {
                return [
                    $this->valueField => $model->id,
                    $this->labelField => $model->name,
                ];
            })->toArray();

        return $this;
    }

    public function relation(callable $callback)
    {
        $callback($this);

        return $this;
    }

    public function multiple(bool $multiple = true)
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function render()
    {
        return view('form::base.form.select', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
            'label' => $this->label,
            'canHide' => $this->canHide,
            'name' => $this->name,
            'multiple' => $this->multiple,
            'reactive' => $this->reactive,
            'valueField' => $this->valueField,
            'maxOptions' => $this->maxOptions,
            'liveSearch' => $this->liveSearch,
            'keySearch' => $this->keySearch,
            'labelField' => $this->labelField,
            'plugins' => $this->plugins,
        ]);
    }
}
