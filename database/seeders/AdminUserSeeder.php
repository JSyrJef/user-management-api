<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Obtener el rol de administrador
        $adminRole = Role::where('name', 'admin')->first();

        // Asignar el rol de administrador al usuario
        if ($adminRole) {
            $admin->roles()->attach($adminRole);
        }
    }
}
