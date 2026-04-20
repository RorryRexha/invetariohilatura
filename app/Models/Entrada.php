<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'folio',
        'producto_id',
        'cantidad',
        'orden_compra',
        'fecha_orden',
        'fecha_ingreso'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}