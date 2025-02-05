<?php

namespace Database\Seeders;

use App\Models\tipo_admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

// Crear un tipo de administrador
$tipoAdmin = tipo_admin::create([
    'tipo' => 'Admin',
]);

// Crear un usuario administrador
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'estado' => 'activo',
    'password' => Hash::make('Admin1234'),
    'tipo_admin_id' => $tipoAdmin->id,
]);

tipo_admin::create([
    'tipo' => 'vendedor',
]);


    }
}
