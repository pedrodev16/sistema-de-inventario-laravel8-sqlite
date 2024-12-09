<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_empresa',
        'fecha_registro',
        'precio_dolar',
        'porcentaje_iva',
        'porcentaje_mercadolibre',
        'porcentaje_ganacia_tienda',
    ];
}
