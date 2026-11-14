<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tutorUser = User::create([
            'name' => 'Profesor Manuel',
            'email' => 'manuel@gmail.com',
            'password' => Hash::make('manuel1234'),
            'role' => 'tutor',
        ]);

        $tutorUser->tutor()->create([
            'especialidad' => 'Programación',
            'descripcion' => 'Experto en Laravel y PHP.',
            'activo' => true,
        ]);

        User::create([
            'name' => 'Ana Estudiante',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('ana123456'),
            'role' => 'estudiante',
        ]);
    }
}