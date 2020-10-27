<?php

namespace App\Services;

use App\Models\User;
use BRCas\User\Repositories\Contracts\UserContract;
use BRCas\User\Services\UserService as ServicesUserService;
use Illuminate\Support\Facades\Hash;

class UserService extends ServicesUserService implements UserContract  {
    
    private function registerPermissions($obj, array $permissions)
    {
        /**
         * @var User;
         */
        $objUser = auth()->user();

        foreach($obj->permissions as $permission){
            if($objUser->can($permission->name) == false) $permissions[] = $permission->id;
        }

        $obj->syncPermissions($permissions);
    }

    private function registerRoles($obj, array $groups)
    {
        /**
         * @var User
         */
        $objUser = auth()->user();
        if($objUser->can('Grupo | Vincular ao Usuário')){
            /**
             * @var User;
             */
            $objUser = auth()->user();

            foreach($obj->permissions as $permission){
                if($objUser->can($permission->name) == false) $permissions[] = $permission->id;
            }

            $obj->syncRoles($groups);
        }
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $obj = User::create($data);
        $this->registerPermissions($obj, $data['permissions'] ?? []);
        $this->registerRoles($obj, $data['roles'] ?? []);

        return $obj;
    }

    public function edit($obj, $data){
        $obj->update($data);
        $this->registerPermissions($obj, $data['permissions'] ?? []);
        $this->registerRoles($obj, $data['roles'] ?? []);
    }
}