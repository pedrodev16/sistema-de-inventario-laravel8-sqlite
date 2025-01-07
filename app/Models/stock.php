<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    public function productos()
    {
        return $this->belongsTo(productos::class, 'id');
    }

    use HasFactory;

    protected $fillable = ['producto_id', 'cantidad', 'ubicacion', 'ubicacion2', 'fecha_entrada', 'fecha_salida', 'estado'];
}
