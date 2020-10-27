<?php

namespace App\Http\Controllers\Admin\User;

use App\Forms\RoleForm;
use App\Http\Controllers\Controller;
use App\Services\RoleService;
use BRCas\Package\Traits\Controller\Web\{Create, Destroy, Edit, Index};

class RoleController extends Controller
{
    use Index, Create, Edit, Destroy;

    public function table()
    {
        return [
            'Name' => ['field' => 'name'],
        ];
    }

    public function service()
    {
        return RoleService::class;
    }

    public function form()
    {
        return RoleForm::class;
    }

    public function indexView()
    {
        return 'admin.role.index';
    }

    public function createView()
    {
        return 'admin.role.create';
    }

    public function editView()
    {
        return 'admin.role.edit';
    }

    public function routeBegging()
    {
        return 'admin.users.roles';
    }
}
