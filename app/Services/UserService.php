<?php

namespace App\Services;

use App\Models\User;
use BRCas\User\Services\UserService as ServicesUserService;
use Illuminate\Support\Facades\Hash;

class UserService extends ServicesUserService  {
    private function registerPermissions($obj, array $permissions)
    {
        $obj->syncPermissions($permissions);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $obj = User::create($data);
        $this->registerPermissions($obj, $data['permissions'] ?? []);

        return $obj;
    }

    public function edit($obj, $data){
        $obj->update($data);
        $this->registerPermissions($obj, $data['permissions'] ?? []);
    }
}