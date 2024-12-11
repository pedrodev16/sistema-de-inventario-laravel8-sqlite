<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuadre extends Model
{
    use HasFactory;


    protected $table = 'cuadre';
    protected $fillable = [
        'fecha',
        'estado',
        'concepto_ingreso',
        'total_ingreso',
        'concepto_egreso',
        'total_egreso',
        'total'
    ];
}
