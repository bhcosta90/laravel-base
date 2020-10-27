<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompanyRepository implements Contracts\CompanyContract {

    public function connectInDatabase($company){
        DB::purge('tenant');
        
        config()->set('database.connections.tenant.host', $company->bd_hostname);
        config()->set('database.connections.tenant.database', $company->bd_database);
        config()->set('database.connections.tenant.username', $company->bd_username);
        config()->set('session.files', storage_path("framework/sessions"));

        DB::reconnect('tenant');
        
        Schema::connection('tenant')->getConnection()->reconnect();
        return $this;
    }

    public function alterConfigSection($company)
    {
        config()->set('session.files', storage_path("framework/sessions"));
        config()->set('session.cookie', sha1($company->id));
        return $this;
    }

    public function createDatabase(string $database){
        if(env('DB_DATABASE') != $database) {
            DB::statement("
                CREATE DATABASE IF NOT EXISTS {$database} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
            ");
        }
        return $this;
    }

    public function dropDatabase(string $database)
    {
        if(env('DB_DATABASE') != $database) {
            DB::statement("
                DROP DATABASE IF EXISTS {$database}
            ");
        }
    }

    public function setDefaultConnection($connectionTenant = false)
    {
        config()->set('database.default', $connectionTenant ? "tenant" : env('DB_CONNECTION', 'mysql'));
        return $this;
    }

    public function getDatabaseByDomain(string $domain): ?Company
    {
        $obj = Company::where('domain', $domain)->first();
        if(empty($obj)){
            $subDomain = explode('.', $domain);
            $obj = Company::where('domain', $subDomain)->first();
        }

        if(!empty($obj)) return $obj;

        return null;
    }
}