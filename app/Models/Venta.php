<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'metodo_pago',];
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
