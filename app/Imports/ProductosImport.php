<?php

namespace App\Imports;

use App\Models\Producto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductosImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            // SALTAR ENCABEZADOS
            if ($index == 0) {
                continue;
            }

            Producto::updateOrCreate(

                // 🔍 BUSCAR POR CODIGO
                [
                    'codigo' => trim($row[0]),
                ],

                // ✏️ DATOS A ACTUALIZAR
                [
                    'descripcion' => trim($row[1]),

                    'unidad_medida' => !empty($row[3])
                        ? trim($row[3])
                        : 'PZ',

                    'fecha_creacion' => now(),
                ]
            );
        }
    }
}