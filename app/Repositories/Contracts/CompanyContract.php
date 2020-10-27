<?php

namespace App\Repositories\Contracts;

interface CompanyContract {
    public function connectInDatabase($company);

    public function createDatabase(string $database);

    public function dropDatabase(string $database);

    public function setDefaultConnection($connectionTenant = false);

    public function getDatabaseByDomain(string $domain);

    public function alterConfigSection($company);
}