<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'metodo_pago',
        'total_proveedor',
        'ganancia',
        'pagomovil',
        'punto_de_venta',
        'transferencias',
        'efectivousd',
        'efectivobs',
        'paypal',
        'zelle'
    ];
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
