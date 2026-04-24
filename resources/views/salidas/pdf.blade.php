<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Salidas</title>
    <style>
        body { font-family: Arial, sans-serif; }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            height: 60px;
        }

        .titulo {
            text-align: center;
            flex-grow: 1;
            font-size: 18px;
            font-weight: bold;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td { 
            border: 1px solid #000; 
            padding: 8px; 
            font-size: 12px; 
        }

        th { background: #eee; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <!-- LOGO -->
        <img src="{{ public_path('images/logoSatex.png') }}" class="logo">

        <!-- TITULO -->
        <div class="titulo">
            REPORTE DE SALIDAS
        </div>

        <!-- ESPACIO -->
        <div style="width: 80px;"></div>
    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salidas as $salida)
                <tr>
                    <td>{{ $salida->folio }}</td>
                    <td>{{ $salida->producto->descripcion ?? 'N/A' }}</td>
                    <td>{{ $salida->cantidad }}</td>
                    <td>{{ \Carbon\Carbon::parse($salida->fecha)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>