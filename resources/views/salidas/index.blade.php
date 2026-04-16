<h1>Salidas</h1>

<a href="{{ route('salidas.create') }}">Nueva Salida</a>

<table border="1">
<tr>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Fecha</th>
    <th>Acciones</th>
</tr>

@foreach($salidas as $salida)
<tr>
    <td>{{ $salida->producto->descripcion }}</td>
    <td>{{ $salida->cantidad }}</td>
    <td>{{ $salida->fecha_salida }}</td>
    <td>
        <a href="{{ route('salidas.edit', $salida->id) }}">Editar</a>

        <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </td>
</tr>
@endforeach
</table>