<?php

namespace App\Exports;

use App\Models\Entrada;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntradasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Entrada::with('producto')->get()->map(function ($e) {
            return [
                'Folio' => $e->folio,
                'Producto' => $e->producto->descripcion,
                'Cantidad' => $e->cantidad . ' ' . $e->producto->unidad_medida,
                'Orden' => $e->orden_compra,
                'Fecha' => $e->fecha_ingreso,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Producto',
            'Cantidad',
            'Orden de Compra',
            'Fecha'
        ];
    }
}
