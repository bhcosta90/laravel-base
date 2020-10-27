<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;
use Spatie\Permission\Models\Permission;

class RoleForm extends Form {
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'label' => __('Name'),
                'rules' => 'required|min:5'
            ]);
        
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
}