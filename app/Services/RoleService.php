<?php

namespace App\Services;

use App\Repositories\Contracts\RoleContract;
use App\Repositories\RoleRepository;
use Spatie\Permission\Models\Role;


class RoleService
{

    /**
     * @var RoleRepository $repository
     */
    private $repository;

    public function __construct(RoleContract $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function create($data)
    {
        $obj = $this->repository->create($data);
        return $obj;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function edit($obj, $data)
    {
        $this->repository->edit($obj, $data);
    }

    public function destroy($obj)
    {
        $obj->delete();
    }
}
