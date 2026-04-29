<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntradasExport implements FromCollection, WithHeadings
{
    protected $entradas;

    // RECIBE LAS ENTRADAS FILTRADAS DESDE EL CONTROLADOR
    public function __construct($entradas)
    {
        $this->entradas = $entradas;
    }

    public function collection()
    {
        return $this->entradas->map(function ($e) {
            return [
                'Folio'    => $e->folio,
                'Producto' => $e->producto->descripcion ?? 'N/A',
                'Cantidad' => $e->cantidad . ' ' . ($e->producto->unidad_medida ?? ''),
                'Orden'    => $e->orden_compra,
                'Fecha'    => $e->fecha_ingreso,
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