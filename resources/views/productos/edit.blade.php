<h1>Editar Producto</h1>

<form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="codigo" value="{{ $producto->codigo }}">
    <input type="text" name="descripcion" value="{{ $producto->descripcion }}">
    <input type="text" name="unidad_medida" value="{{ $producto->unidad_medida }}">

    <button type="submit">Actualizar</button>
</form>