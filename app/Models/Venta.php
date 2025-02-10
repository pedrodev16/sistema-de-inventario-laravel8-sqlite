<?php

namespace App\Models;

use Carbon\Carbon;
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
    // Función para obtener las ventas del día
    public static function ventasDelDia()
    {
        return self::whereDate('created_at', Carbon::today())->count();
    }



    public static function totalVentasDelDia()
    {
        return self::whereDate('created_at', Carbon::today())->sum('total');
    }

    public static function gananciasDelDia()
    {
        return self::whereDate('created_at', Carbon::today())->sum('ganancia');
    }
}
