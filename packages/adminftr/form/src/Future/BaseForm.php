<?php

namespace Adminftr\Form\Future;

use Adminftr\Form\Future\Components\Form;
use Adminftr\Form\Future\Components\UrlHelper;
use Adminftr\Form\Future\Traits\DataInitializationTrait;
use Adminftr\Form\Future\Traits\DataPersistenceTrait;
use Adminftr\Form\Future\Traits\DataValidationTrait;
use Adminftr\Form\Future\Traits\FieldExtractionTrait;
use Adminftr\Form\Future\Traits\NotificationTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;

abstract class BaseForm extends Component
{
    use DataInitializationTrait,
        DataPersistenceTrait,
        DataValidationTrait,
        FieldExtractionTrait,
        NotificationTrait;

    #[Locked]
    public $id;

    public array $data = [];

    #[Locked]
    public $url;

    protected $form;

    protected $model;

    public function mount(?string $id = null, ?string $url = null)
    {
        $this->id = $id;
        $this->url = $url;
        UrlHelper::setUrl($this->url);
        $inputs = $this->getInputFields();
        $this->initializeData($inputs);
    }

    public function render()
    {
        return view('form::base-form');
    }

    protected function Actions()
    {
        return [];
    }

    public function updated($property)
    {
        $this->afterStateUpdated($property);
    }

    protected function afterStateUpdated($property)
    {
        $this->skipRender();
        $inputs = $this->getInputFields();
        foreach ($inputs as $input) {
            if ($input->afterStateUpdated && 'data.'.$input->name == $property) {
                $this->data = call_user_func($input->afterStateUpdated, $this->data);
            }
        }
    }

    public function boot()
    {
        UrlHelper::setUrl($this->url);
        $this->form = $this->form(new Form());
    }

    abstract public function form(Form $form);

    public function save()
    {
        $this->skipRender();
        DB::beginTransaction();
        try {
            if(!empty($this->rules())){
                $this->validate($this->rules(),$this->messages());
            }

            $url = $this->url;
            if (str_contains($url, 'edit')) {
                $this->data = $this->beforeUpdate($this->data);
            } else {
                $this->data = $this->beforeSave($this->data);
            }
            $this->persistData();
            if (function_exists('afterSave')) {
                return $this->afterSave($this->data);
            }
            DB::commit();
            $this->notificationOk('Save success');
        } catch (Exception $e) {
            DB::rollBack();
            $this->notificationError($e->getMessage());
        }
    }

    protected function beforeSave(array $data)
    {
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        return $data;
    }

    public function searchSelect($value, $field)
    {
        $this->skipRender();
        $selectFields = $this->getSelectFields();

        foreach ($selectFields as $selectField) {
            if ($selectField->name == $field) {
                return $selectField->search($value)->options;
            }
        }

        return [];
    }

    public function inputActions($name)
    {
        $this->skipRender();
        $inputs = $this->getInputFields();
        foreach ($inputs as $input) {
            if ($input->name == $name) {
                call_user_func($input->action['action'], $this);
            }
        }
    }

    public function methodActions($name)
    {
        $this->skipRender();
        $actions = $this->Actions();
        foreach ($actions as $action) {
            if ($action->name == $name) {
                call_user_func($action->callback, $this);
            }
        }
    }
}
