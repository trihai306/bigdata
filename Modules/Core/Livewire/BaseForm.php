<?php

namespace Modules\Core\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Modules\Core\Livewire\Forms\Form;
use Modules\Core\Livewire\Forms\Fields\TextInput;

abstract class BaseForm extends Component
{
    protected $form;

    public $id;
    protected $model;
    public array $data = [];

    public function mount(string $id = null)
    {
        $this->id = $id;
        if ($this->id) {
            $this->model = $this->model::find($this->id);
//            dd($this->form(new Form())->render());
            $this->data = $this->model->toArray();
        }
    }

    public function render()
    {
        $this->form = $this->form(new Form());
        return view('core::livewire.base-form', ['inputs' => $this->form->render()]);
    }

    protected function beforeSave()
    {
        return $this->data;
    }

    protected function afterSave($data)
    {
        return $data;
    }

    public function save()
    {
        $this->validate();
        try {
            $this->data = $this->beforeSave();
            if ($this->id) {
                $model = $this->model::updateOrCreate([
                    'id' => $this->id
                ],$this->data);
                $this->data = $model->toArray();
            } else {
                $model = $this->model::create($this->data);
            }
            if (!$this->id) {
                $this->data = [];
            }
            $this->dispatch('swalSuccess', ['message' => 'Saved Successfully']);
        } catch (\Exception $e) {
            $this->dispatch('swalError', ['message' => $e->getMessage()]);
        }
    }

    abstract public function form(Form $form);
}
