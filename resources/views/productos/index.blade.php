<h1>Productos</h1>

<a href="{{ route('productos.create') }}">Nuevo Producto</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Código</th>
        <th>Descripción</th>
        <th>Unidad</th>
        <th>Acciones</th>
    </tr>

    @foreach($productos as $producto)
    <tr>
        <td>{{ $producto->codigo }}</td>
        <td>{{ $producto->descripcion }}</td>
        <td>{{ $producto->unidad_medida }}</td>
        <td>
            <a href="{{ route('productos.edit', $producto->id) }}">Editar</a>

            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>