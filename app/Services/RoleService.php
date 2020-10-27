<?php

namespace App\Services;

use Spatie\Permission\Models\Role;


class RoleService {
    private function registerPermissions($obj, array $permissions)
    {
        /**
         * @var \App\Models\User;
         */
        $objUser = auth()->user();

        foreach($obj->permissions as $permission){
            if($objUser->can($permission->name) == false) $permissions[] = $permission->id;
        }
        
        $obj->syncPermissions($permissions);
    }

    public function index()
    {
        return app(Role::class)->all();
    }

    public function create($data)
    {
        $obj = Role::create($data);
        $this->registerPermissions($obj, $data['roles']);
        return $obj;
    }

    public function find($id)
    {
        return Role::find($id);
    }

    public function edit($obj, $data)
    {
        $obj->update($data);
        $this->registerPermissions($obj, $data['permissions']);
    }

    public function destroy($obj){
        $obj->delete();
    }
}