<?php

namespace App\Http\Controllers\Admin\User;

use App\Forms\RoleForm;
use App\Http\Controllers\Controller;
use App\Services\RoleService;
use BRCas\Laravel\Traits\Controller\Web\{Create, Destroy, Edit, Index};
use BRCas\Laravel\Traits\Support\Permission;

class RoleController extends Controller
{
    use Index, Create, Edit, Destroy, Permission;

    public function permissions()
    {
        return [
            'index' => 'Grupo | Relatório',
            'create' => 'Grupo | Cadastro',
            'edit' => 'Grupo | Edição',
            'delete' => 'Grupo | Excluir',
        ];
    }

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
