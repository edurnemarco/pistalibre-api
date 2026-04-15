<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nombre' => 'Ane Gaztañaga',
            'email' => 'ane@pistalibre.com',
            'password' => Hash::make('password123'),
            'tipo' => 'artista',
            'ciudad' => 'Vitoria-Gasteiz',
            'region' => 'País Vasco',
            'pais' => 'ES',
            'bio' => 'Artista visual graduada en Bellas Artes por la UPV/EHU. Mi práctica se centra en la fotografía documental y el videoarte.',
            'activo' => true,
        ]);

        User::create([
            'nombre' => 'Trama estudio',
            'email' => 'trama@pistalibre.com',
            'password' => Hash::make('password123'),
            'tipo' => 'institucion',
            'ciudad' => 'Pamplona',
            'region' => 'Navarra',
            'pais' => 'ES',
            'bio' => 'Espacio creativo autogestionado en Pamplona. Organizamos talleres, exposiciones y residencias.',
            'activo' => true,
        ]);

        User::create([
            'nombre' => 'Admin',
            'email' => 'admin@pistalibre.com',
            'password' => Hash::make('password123'),
            'tipo' => 'admin',
            'ciudad' => 'Pamplona',
            'region' => 'Navarra',
            'pais' => 'ES',
            'activo' => true,
        ]);
    }
}