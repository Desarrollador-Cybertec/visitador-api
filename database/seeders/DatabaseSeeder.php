<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Administrador', 'slug' => 'admin']);
        Role::create(['name' => 'Visitador', 'slug' => 'visitador']);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@visitador.com',
            'password' => bcrypt('password'),
            'phone' => '3000000000',
            'role_id' => $adminRole->id,
        ]);
    }
}
