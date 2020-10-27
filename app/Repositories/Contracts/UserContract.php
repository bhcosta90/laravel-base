<?php

namespace App\Repositories\Contracts;

use BRCas\User\Repositories\Contracts\UserContract as ContractsUserContract;

interface UserContract extends ContractsUserContract
{
    public function registerPermissions($obj, array $permissions);

    public function registerRoles($obj, array $groups);
}