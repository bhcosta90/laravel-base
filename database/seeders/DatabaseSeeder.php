<?php

namespace Database\Seeders;

use App\Services\CompanyService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::factory()->create([
            'domain' => 'localhost',
            'bd_hostname' => env('DB_HOST'),
            'bd_database' => env('DB_DATABASE'),
            'bd_username' => env('DB_USERNAME'),
        ]);
    }
}
