<h1>Nueva Entrada</h1>

<form action="{{ route('entradas.store') }}" method="POST">
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
<input type="text" name="orden_compra" placeholder="Orden de compra">
<input type="date" name="fecha_orden">
<input type="date" name="fecha_ingreso">

<button>Guardar</button>
</form>