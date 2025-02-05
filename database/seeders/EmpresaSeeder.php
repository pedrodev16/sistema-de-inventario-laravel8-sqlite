<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'nombre_empresa' => 'Empresa Ejemplo 1',
            'fecha_registro' => now(),
            'precio_dolar' => 4.23,
            'porcentaje_iva' => 16.00,
            'porcentaje_mercadolibre' => 5.50,
            'porcentaje_ganacia_tienda' => 10.00,
        ]);
    }
}
