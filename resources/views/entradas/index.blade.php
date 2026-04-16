<h1>Entradas</h1>

<a href="{{ route('entradas.create') }}">Nueva Entrada</a>

<table border="1">
<tr>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Orden</th>
    <th>Fecha Ingreso</th>
    <th>Acciones</th>
</tr>

@foreach($entradas as $entrada)
<tr>
    <td>{{ $entrada->producto->descripcion }}</td>
    <td>{{ $entrada->cantidad }}</td>
    <td>{{ $entrada->orden_compra }}</td>
    <td>{{ $entrada->fecha_ingreso }}</td>
    <td>
        <a href="{{ route('entradas.edit', $entrada->id) }}">Editar</a>

        <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </td>
</tr>
@endforeach
</table>
