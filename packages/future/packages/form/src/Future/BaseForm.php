<?php

namespace Future\Form\Future;


use Future\Form\Future\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

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
            $this->data = $this->model->toArray();
        }
    }

    public function render()
    {
        $this->form = $this->form(new Form());
        return view('future::base-form', ['inputs' => $this->form->render()]);
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
        dd($this->data);
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
