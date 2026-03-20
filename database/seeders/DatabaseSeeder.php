<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // llamar a Role Seeder
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BloodTypeSeeder::class,
            SpecialitySeeder::class,
        ]);

        // crear un usuario de prueba cada que se ejecuten migraciones
        // php artisan migrate:fresh --seed

    }
}
