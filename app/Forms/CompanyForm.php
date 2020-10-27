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
            ])->add('domain', Field::TEXT, [
                'label' => __('Domain'),
                'rules' => 'required|min:5|unique:companies,domain'
            ])->add('user', 'form', [
                'type' => 'form',
                'class' => CompanyUserForm::class,
            ]);
    }
}