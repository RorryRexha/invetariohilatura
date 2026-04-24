<?php

namespace App\Exports;

use App\Models\Salida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalidasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Salida::with('producto')->get()->map(function ($salida) {
            return [
                'folio' => $salida->folio,
                'producto' => $salida->producto->descripcion ?? 'N/A',
                'cantidad' => $salida->cantidad,
                'fecha' => $salida->fecha,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Producto',
            'Cantidad',
            'Fecha'
        ];
    }
}