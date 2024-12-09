<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'costo', 'porcentaje_ganacia_tienda', 'proveedor_id', 'categorias_id', 'marcas_id', 'codigo', 'user_id'];

    public function user_m()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
    public function categorias()
    {

        return $this->belongsTo(Categorias::class, 'categorias_id');
    }
    public function marcas()
    {

        return $this->belongsTo(marcas::class, 'marcas_id');
    }

    public function stock()
    {

        return $this->belongsTo(stock::class, 'id');
    }
}
