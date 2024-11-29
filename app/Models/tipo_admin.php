<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_admin extends Model
{
    use HasFactory;
    protected $table = 'tipo_admins';
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'tipo_admin_id');
    // }
    public static function obtenerIdYNombre()
    {
        return self::select('id', 'tipo')->get();
    }
}
