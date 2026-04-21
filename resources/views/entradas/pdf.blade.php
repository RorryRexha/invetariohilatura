<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Entradas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>

    <h2>Reporte de Entradas</h2>

    <table>
        <thead>
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Orden</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->folio }}</td>
                    <td>{{ $entrada->producto->descripcion ?? 'N/A' }}</td>
                    <td>{{ $entrada->cantidad }}</td>
                    <td>{{ $entrada->orden_compra }}</td>
                    <td>{{ \Carbon\Carbon::parse($entrada->fecha_ingreso)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>