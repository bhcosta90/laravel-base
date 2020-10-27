<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class CompanyForm extends Form {
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'label' => __('Name'),
                'rules' => 'required|min:5'
            ]);
    }
}