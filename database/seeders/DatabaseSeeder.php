<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // llamar a Role Seeder
        $this->call([
            RoleSeeder::class
        ]);

        //crear un usuario de prueba cada que se ejecuten migraciones
        //php artisan migrate:fresh --seed
        User::factory()->create([
            'name' => 'Karlos',
            'email' => 'karlos.duran@tecdesoftware.edu.mx',
            'password' => bcrypt('12345678'),
        ]);
    }
}
