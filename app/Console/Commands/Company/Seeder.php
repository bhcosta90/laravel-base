<?php

namespace App\Console\Commands\Company;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Console\Command;

class Seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:seeder';

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
        $companies = Company::distinct('bd_database')->select(['bd_database', 'id'])->get();
        foreach($companies as $company) {
            app(CompanyService::class)->dropDatabase($company->bd_database);
        }

        $this->call('migrate:fresh', ['--seed' => true]);
        foreach($companies as $company) {
            $this->call('company:migrate', ['--id' => $company->id, '--seed' => true]);
        }
        
        return 0;
    }
}
