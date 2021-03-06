<?php

namespace App\Repositories\Contracts;

interface RoleContract
{
    public function index();

    public function create($data);

    public function find($id);

    public function edit($obj, $data);

    public function destroy($obj);
}
