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
        // Limpiar usuarios viejos o de prueba
        User::query()->truncate();

        // 1. Cuenta de Soporte Técnico / TI
        User::create([
            'name' => 'Informática HMZ',
            'email' => 'informatica@soluteza.com',
            'password' => Hash::make('Z@catecas26'),
            'role_slug' => 'informatica',
        ]);

        // 2. Cuenta de Dirección / Administración (Comparte accesos con TI)
        User::create([
            'name' => 'Administración General',
            'email' => 'administracion@soluteza.com',
            'password' => Hash::make('Z@catecas26'), // Usa la misma o tu variante segura
            'role_slug' => 'administrador',
        ]);

        // 3. Cuenta de Operativa (Enseñanza / Capacitación)
        User::create([
            'name' => 'Enseñanza HMZ',
            'email' => 'ensenanza@soluteza.com',
            'password' => Hash::make('H@spital26'),
            'role_slug' => 'ensenanza',
        ]);
    }
}
