<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Entrada;
use App\Models\Salida;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();

        $entradasHoy = Entrada::whereDate('fecha_ingreso', now())->count();
        $salidasHoy = Salida::whereDate('fecha', now())->count();

        $entradas = Entrada::with('producto')
            ->latest('fecha_ingreso')
            ->take(5)
            ->get()
            ->map(function ($e) {
                return [
                    'tipo' => 'entrada',
                    'producto' => $e->producto->descripcion,
                    'cantidad' => $e->cantidad,
                    'fecha' => $e->fecha_ingreso,
                ];
            });

        $salidas = Salida::with('producto')
            ->latest('fecha')
            ->take(5)
            ->get()
            ->map(function ($s) {
                return [
                    'tipo' => 'salida',
                    'producto' => $s->producto->descripcion,
                    'cantidad' => $s->cantidad,
                    'fecha' => $s->fecha,
                ];
            });

        $movimientos = $entradas->merge($salidas)->sortByDesc('fecha')->take(5);

        return view('dashboard', compact(
            'totalProductos',
            'entradasHoy',
            'salidasHoy',
            'movimientos'
        ));
    }
}