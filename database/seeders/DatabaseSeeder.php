<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (User::whereEmail($email = 'owner@gmail.com')->doesntExist()) {
            User::factory()->create([
                'name'  => 'Owner User',
                'email' => $email,
            ]);
        }

        $this->call([
            UserSeeder::class,
        ]);
    }
}
