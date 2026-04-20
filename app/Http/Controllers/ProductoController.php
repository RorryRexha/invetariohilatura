<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // LISTAR
    public function index()
    {
        
            $productos = Producto::with(['entradas', 'salidas'])->get();

            return view('productos.index', compact('productos'));
    }
    

    // FORM CREAR
    public function create()
    {
        return view('productos.create');
    }

    //  GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:productos',
            'descripcion' => 'required',
            'unidad_medida' => 'required',
        ]);

        Producto::create([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'unidad_medida' => $request->unidad_medida,
            'fecha_creacion' => now(),
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    //  FORM EDITAR
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    //  ACTUALIZAR
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'codigo' => 'required|unique:productos,codigo,' . $id,
            'descripcion' => 'required',
            'unidad_medida' => 'required',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado');
    }


}