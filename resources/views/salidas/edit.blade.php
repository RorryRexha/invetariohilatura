<h1>Editar Salida</h1>

<form action="{{ route('salidas.update', $salida->id) }}" method="POST">
@csrf
@method('PUT')

<select name="producto_id">
    @foreach($productos as $producto)
        <option value="{{ $producto->id }}"
            {{ $producto->id == $salida->producto_id ? 'selected' : '' }}>
            {{ $producto->descripcion }}
        </option>
    @endforeach
</select>

<input type="number" name="cantidad" value="{{ $salida->cantidad }}">
<input type="date" name="fecha_salida" value="{{ $salida->fecha_salida }}">

<button>Actualizar</button>
</form>