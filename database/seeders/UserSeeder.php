<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Karlos',
            'email' => 'karlos.duran@tecdesoftware.edu.mx',
            'password' => bcrypt('12345678'),
            'id_number' => '12345678',
            'phone' => '1234567899',
            'address' => 'calle 123',
        ])->assignRole('Doctor');
        ;
    }
}
