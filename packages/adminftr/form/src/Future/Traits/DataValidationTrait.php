<?php

namespace Future\Form\Future\Traits;

trait DataValidationTrait
{
    private function validateData()
    {
        if (method_exists($this, 'rules')) {
            if ($this->rules()) {
                $this->validate($this->rules());
            }
        }
    }

    public function rules()
    {
        $inputs = $this->getInputFields();
        $rules = [];
        foreach ($inputs as $input) {
            if ($input->rule) {
                $rules['data.'.$input->name] = $input->rule;
            }
        }

        return $rules;
    }
}
