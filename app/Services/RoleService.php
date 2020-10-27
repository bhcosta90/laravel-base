<?php

namespace App\Services;

use Spatie\Permission\Models\Role;


class RoleService {
    public function index()
    {
        return app(Role::class)->all();
    }

    public function create($data)
    {
        dd($data);
    }
}