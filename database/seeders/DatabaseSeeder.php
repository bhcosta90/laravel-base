<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        \App\Models\Company::factory()->create([
            'domain' => 'localhost1',
            'bd_hostname' => env('DB_HOST'),
            'bd_database' => env('DB_DATABASE') . '_multitenant',
            'bd_username' => env('DB_USERNAME'),
        ]);
    }
}
