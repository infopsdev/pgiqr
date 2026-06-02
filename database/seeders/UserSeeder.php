<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador del Departamento de Informática
        User::updateOrCreate(
            ['email' => 'admin@pgiqr.test'], // Evita duplicados si se corre dos veces
            [
                'name' => 'Administrador Informática',
                'password' => Hash::make('Abc1234'), // Contraseña segura de desarrollo
            ]
        );
    }
}
