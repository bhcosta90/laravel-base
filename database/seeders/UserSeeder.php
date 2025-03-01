<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'System Admin',
            'login' => 'admin@admin.com',
        ]);

        User::factory()->create([
            'name'  => 'System Admin',
            'login' => 'admin.admin',
        ]);
    }
}
