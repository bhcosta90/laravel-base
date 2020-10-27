<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Repositories\Contracts\CompanyContract;

class CompanyService  {
    
    /**
     * @var CompanyRepository $repository
     */
    private $repository;

    public function __construct(CompanyContract $repository)
    {
        $this->repository = $repository;
    }

    public function alterConfig(Company $company)
    {
        $this->repository->connectInDatabase($company)->alterConfigSection($company);
    }

    public function createDatabase(string $database)
    {
        $this->repository->createDatabase($database);
    }

    public function dropDatabase(string $database)
    {
        $this->repository->dropDatabase($database);
    }

    public function setDefaultConnection(bool $tenant)
    {
        return $this->repository->setDefaultConnection($tenant);
    }

    public function getCompanyByDomain(string $domain)
    {
        return $this->repository->getDatabaseByDomain($domain);
    }
}