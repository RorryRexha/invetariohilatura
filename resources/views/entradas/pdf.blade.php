<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Entradas</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 25px;
        }

        .header{
            width: 100%;
            margin-bottom: 20px;
        }

        .logo{
            width: 120px;
        }

        .titulo{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: -55px;
        }

        .subtitulo{
            text-align: center;
            font-size: 11px;
            color: #555;
            margin-top: 5px;
        }

        .fecha{
            text-align: right;
            font-size: 11px;
            margin-top: 15px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th{
            background: #e5e7eb;
            border: 1px solid #000;
            padding: 7px;
            font-size: 11px;
            text-align: center;
        }

        td{
            border: 1px solid #000;
            padding: 7px;
            font-size: 11px;
        }

        .text-center{
            text-align: center;
        }

        .text-right{
            text-align: right;
        }

        .codigo{
            color: #1d4ed8;
            font-weight: bold;
        }

        .footer{
            margin-top: 15px;
            font-size: 11px;
            text-align: right;
            font-weight: bold;
        }

        .vacio{
            text-align: center;
            padding: 12px;
        }
    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <div class="header">

        <img src="{{ public_path('images/logoSatex.png') }}" class="logo">

        <div class="titulo">
            REPORTE DE ENTRADAS
        </div>

        <div class="subtitulo">
            Sistema de Inventario - Hilatura
        </div>

        <div class="fecha">
            Fecha de impresión:
            {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </div>

    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Código</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Orden Compra</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>

            @forelse($entradas as $entrada)
                <tr>
                    <td class="text-center">
                        {{ $entrada->folio }}
                    </td>

                    <td class="text-center codigo">
                        {{ $entrada->producto->codigo ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $entrada->producto->descripcion ?? 'N/A' }}
                    </td>

                    <td class="text-right">
                        {{ $entrada->cantidad }}
                        {{ $entrada->producto->unidad_medida ?? '' }}
                    </td>

                    <td class="text-center">
                        {{ $entrada->orden_compra }}
                    </td>

                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($entrada->fecha_ingreso)->format('d/m/Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="vacio">
                        No se encontraron registros.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Total de registros: {{ $entradas->count() }}
    </div>

</body>
</html>