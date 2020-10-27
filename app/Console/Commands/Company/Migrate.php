<?php

namespace App\Console\Commands\Company;

use App\Models\Company;
use App\Services\CompanyService;
use Database\Seeders\CompanySeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:migrate {--id=} {--refresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($id = $this->option('id')) {
            $company = Company::find($id);

            if ($company)
                $this->execCommand($company);

            return;
        }

        $companies = Company::all();

        foreach ($companies as $company) {
            $this->execCommand($company);
        }

        return 0;
    }

    private function execCommand(Company $company)
    {
        $company->update(['migrated' => true]);
        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $this->info("Connecting Company - {$company->name}");

        app(CompanyService::class)->alterConfig($company);

        $paramDatabase = ['--database' => "tenant"];

        $params = [
            '--force' => true,
            '--path' => '/database/migrations/company',
        ];
        
        if(!app()->environment('testing')){
            $params += $paramDatabase;
        }

        $this->call($command, $params);

        if($this->option('seed')) {
            $params = [
                '--class' => CompanySeeder::class
            ];

            if(!app()->environment('testing')){
                $params += $paramDatabase;
            }

            if(!app()->environment('production')){
                $this->call('db:seed', $params);
            }
        }

        $this->info("End Connecting Company - {$company->name}");
        $this->info('-----------------------------------------');
        $company->update(['migrated' => true]);
    }
}
