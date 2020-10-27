<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\Permission;

class UserForm extends Form {
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'label' => __('Name'),
                'rules' => 'required|min:5'
            ])
            ->add('email', Field::EMAIL, [
                'label' => __('Email'),
                'rules' => 'required|email|min:5'
            ]);

        if(empty($this->request->route('user'))){
            $this->add('password', Field::PASSWORD, [
                'label' => __('Password'),
                'rules' => 'required|min:6|max:16'
            ]);
        }

        $objPermission = Permission::all();
        $permissions = [];

        foreach($objPermission as $rs){
            list($module, $permission) = explode('|', $rs->name);
            $permissions[$module][$rs->id] = __($permission);
        }

        $this->add('permissions', Field::SELECT, [
            'label' => __("Permissions"),
            'attr' => [
                'multiple' => true,
            ],
            'choices' => $permissions,
        ]);
    }
}