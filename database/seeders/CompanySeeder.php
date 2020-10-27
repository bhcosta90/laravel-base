<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 20;
        if(User::count() == 0) {
            User::factory()->create(['email' => 'admin@admin.com', 'name' => 'Administrador Geral']);
            $total--;
        }
        
        User::factory($total)->create();
    }
}
