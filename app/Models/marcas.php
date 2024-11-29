<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marcas extends Model
{
    use HasFactory;
    public function user_m()
    {
        //return $this->hasMany(Categorias::class, 'user_id');
        return $this->belongsTo(User::class, 'user_id');
        //return $this->belongsToMany(Categorias::class, 'user_id');
        //return $this->hasOne(Categorias::class, 'user_id');
    }
    protected $fillable = [
        'nombre',
        'estado',
        'user_id',

    ];
}
