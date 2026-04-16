<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = [
        'producto_id',
        'cantidad',
        'fecha_salida'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}