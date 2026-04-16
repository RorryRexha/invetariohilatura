<h1>Nueva Salida</h1>

<form action="{{ route('salidas.store') }}" method="POST">
@csrf

<select name="producto_id">
    <option value="">Seleccionar producto</option>
    @foreach($productos as $producto)
        <option value="{{ $producto->id }}">
            {{ $producto->descripcion }}
        </option>
    @endforeach
</select>

<input type="number" name="cantidad" placeholder="Cantidad">
<input type="date" name="fecha_salida">

<button>Guardar</button>
</form>