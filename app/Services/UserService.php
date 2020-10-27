<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserContract;
use BRCas\User\Services\UserService as ServicesUserService;

class UserService extends ServicesUserService implements UserContract  {

    protected $repository;

    public function __construct(UserContract $repository)
    {
        $this->repository = $repository;
    }

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

    public function create(array $data)
    {
        $obj = $this->repository->create($data);

        $this->registerPermissions($obj, $data['permissions'] ?? []);
        $this->registerRoles($obj, $data['roles'] ?? []);

        return $obj;
    }

    public function edit($obj, $data){
        $this->repository->edit($obj, $data);

        $this->registerPermissions($obj, $data['permissions'] ?? []);
        $this->registerRoles($obj, $data['roles'] ?? []);
    }
}