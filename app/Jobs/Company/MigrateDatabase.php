<?php

namespace App\Jobs\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\CompanyService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class MigrateDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $company;

    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company, array $user)
    {
        $this->company = $company;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $objService = app(CompanyService::class);

        $company = $this->company;
        
        $objService->createDatabase($company->bd_database);
        $objService->alterConfig($company);
        Artisan::call('company:migrate', ['--id' => $company->id]);
        $objService->setDefaultConnection(true);

        User::create($this->user);
    }
}
