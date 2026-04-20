<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'codigo',
        'descripcion',
        'unidad_medida',
        'fecha_creacion'
    ];

    // RELACIONES
    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class);
    }

    // STOCK DINÁMICO 
    public function getStockAttribute()
    {
        return $this->entradas->sum('cantidad') 
             - $this->salidas->sum('cantidad');
    }
}