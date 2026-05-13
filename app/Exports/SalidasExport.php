<?php

namespace App\Exports;

use App\Models\Salida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalidasExport implements FromCollection, WithHeadings
{
    protected $buscar;

    public function __construct($buscar)
    {
        $this->buscar = $buscar;
    }

    public function collection()
    {
        return Salida::with('producto')

            ->when($this->buscar, function ($query) {

                $query->where('folio', 'LIKE', "%{$this->buscar}%")

                    ->orWhereHas('producto', function ($q) {

                        $q->where('descripcion', 'LIKE', "%{$this->buscar}%")
                          ->orWhere('codigo', 'LIKE', "%{$this->buscar}%");

                    });

            })

            ->latest()
            ->get()

            ->map(function ($salida) {

                return [
                    'folio' => $salida->folio,
                    'producto' => $salida->producto->descripcion ?? 'N/A',
                    'cantidad' => $salida->cantidad,
                    'fecha' => $salida->fecha,
                    'motivo' => $salida->motivo_salida,
                ];

            });
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Producto',
            'Cantidad',
            'Fecha',
            'Motivo'
        ];
    }
}