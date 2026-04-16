<h1>Editar Entrada</h1>

<form action="{{ route('entradas.update', $entrada->id) }}" method="POST">
@csrf
@method('PUT')

<select name="producto_id">
    @foreach($productos as $producto)
        <option value="{{ $producto->id }}"
            {{ $producto->id == $entrada->producto_id ? 'selected' : '' }}>
            {{ $producto->descripcion }}
        </option>
    @endforeach
</select>

<input type="number" name="cantidad" value="{{ $entrada->cantidad }}">
<input type="text" name="orden_compra" value="{{ $entrada->orden_compra }}">
<input type="date" name="fecha_orden" value="{{ $entrada->fecha_orden }}">
<input type="date" name="fecha_ingreso" value="{{ $entrada->fecha_ingreso }}">

<button>Actualizar</button>
</form>