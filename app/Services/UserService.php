<?php

namespace App\Services;

use BRCas\User\Services\UserService as ServicesUserService;

class UserService extends ServicesUserService  {
    private function registerPermissions($obj, array $permissions)
    {
        $obj->syncPermissions($permissions);
    }

    public function edit($obj, $data){
        $obj->update($data);
        $this->registerPermissions($obj, $data['permissions'] ?? []);
    }
}