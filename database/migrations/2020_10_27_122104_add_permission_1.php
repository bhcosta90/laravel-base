<?php

use App\Traits\Permission;
use Illuminate\Database\Migrations\Migration;

class AddPermission1 extends Migration
{
    use Permission;

    public function permissions(): array
    {
        return [
            'Usuário | Relatório',
            'Usuário | Cadastro',
            'Usuário | Edição',
            'Usuário | Excluir',

            'Grupo | Relatório',
            'Grupo | Cadastro',
            'Grupo | Edição',
            'Grupo | Excluir',
            'Grupo | Vincular ao Usuário',
        ];
    }
}
