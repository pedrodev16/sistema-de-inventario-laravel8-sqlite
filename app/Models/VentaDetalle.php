<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio', 'subtotal', 'precio_proveedor', 'subtotal_proveedor'];
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
    public function producto()
    {
        return $this->belongsTo(productos::class);
    }

    public static function productosMasVendidos()
    {
        return self::select('producto_id', DB::raw('SUM(cantidad) as total_cantidad'))
        ->groupBy('producto_id')
        ->orderBy('total_cantidad', 'desc')
        ->take(20)
            ->get();
    }
}
