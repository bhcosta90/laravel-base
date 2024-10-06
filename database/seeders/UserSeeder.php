<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(30)->create([
            'created_at' => now()->addSecond(),
        ]);
    }
}
