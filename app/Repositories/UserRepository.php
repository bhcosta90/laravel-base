<?php

namespace App\Repositories;

use BRCas\User\Repositories\UserRepository as RepositoriesUserRepository;
use Spatie\Permission\Models\Role;


class UserRepository extends RepositoriesUserRepository implements Contracts\UserContract{
    
    public function registerPermissions($obj, array $permissions)
    {
        /**
         * @var User;
         */
        if($objUser = auth()->user()){

            foreach($obj->permissions as $permission){
                if($objUser->can($permission->name) == false) $permissions[] = $permission->id;
            }

            $obj->syncPermissions($permissions);
        }
    }

    public function registerRoles($obj, array $groups)
    {
        /**
         * @var User
         */
        if(($objUser = auth()->user()) && $objUser->can('Grupo | Vincular ao Usuário')){
            foreach($obj->permissions as $permission){
                if($objUser->can($permission->name) == false) $permissions[] = $permission->id;
            }

            $obj->syncRoles($groups);
        }
    }

}