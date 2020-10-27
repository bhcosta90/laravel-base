<?php

namespace App\Forms;

use App\Models\User;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\{Permission, Role};

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

        $this->permissions();
        $this->roles();
    }

    private function permissions()
    {
        $objPermission = Permission::all();
        $permissions = [];

        foreach($objPermission as $rs){
            /**
             * @var User
             */
            $user = auth()->user();
            list($module, $permission) = explode('|', $rs->name);
            if($user->can($rs->name)){
                $permissions[$module][$rs->id] = __($permission);
            }
        }

        if(!empty($permissions)){
            $this->add('permissions', Field::SELECT, [
                'label' => __("Permissions"),
                'attr' => [
                    'multiple' => true,
                ],
                'choices' => $permissions,
            ]);
        }
    }

    private function roles()
    {
        $objPermission = Role::all();
        $permissions = [];

        foreach($objPermission as $rs){
            /**
             * @var User
             */
            $user = auth()->user();
            list($module, $permission) = explode('|', $rs->name);
            if($user->can($rs->name)){
                $permissions[$module][$rs->id] = __($permission);
            }
        }

        if(!empty($permissions)){
            $this->add('permissions', Field::SELECT, [
                'label' => __("Permissions"),
                'attr' => [
                    'multiple' => true,
                ],
                'choices' => $permissions,
            ]);
        }
    }
}