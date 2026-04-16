<h1>Crear Producto</h1>

<form action="{{ route('productos.store') }}" method="POST">
    @csrf

    <input type="text" name="codigo" placeholder="Código">
    <input type="text" name="descripcion" placeholder="Descripción">
    <input type="text" name="unidad_medida" placeholder="Unidad">

    <button type="submit">Guardar</button>
</form>