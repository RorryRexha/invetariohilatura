<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $fillable = [
        'folio',
        'producto_id',
        'cantidad',
        'fecha'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}