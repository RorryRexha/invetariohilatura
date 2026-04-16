<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    // 📄 LISTAR
    public function index()
    {
        $salidas = Salida::with('producto')->get();
        return view('salidas.index', compact('salidas'));
    }

    // ➕ FORM
    public function create()
    {
        $productos = Producto::all();
        return view('salidas.create', compact('productos'));
    }

    // 💾 GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'fecha_salida' => 'required|date',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // 🚨 Validar stock
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock');
        }

        // Guardar salida
        Salida::create($request->all());

        // Descontar stock
        $producto->stock -= $request->cantidad;
        $producto->save();

        return redirect()->route('salidas.index')
            ->with('success', 'Salida registrada');
    }

    // ✏️ EDIT
    public function edit($id)
    {
        $salida = Salida::findOrFail($id);
        $productos = Producto::all();

        return view('salidas.edit', compact('salida', 'productos'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $salida = Salida::findOrFail($id);
        $producto = Producto::findOrFail($request->producto_id);

        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'fecha_salida' => 'required|date',
        ]);

        // 🔁 Ajustar stock (devolver lo anterior)
        $producto->stock += $salida->cantidad;

        // Validar nuevo stock
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'Stock insuficiente');
        }

        // Restar nueva cantidad
        $producto->stock -= $request->cantidad;
        $producto->save();

        $salida->update($request->all());

        return redirect()->route('salidas.index')
            ->with('success', 'Salida actualizada');
    }

    // 🗑️ DELETE
    public function destroy($id)
    {
        $salida = Salida::findOrFail($id);
        $producto = $salida->producto;

        // 🔁 Regresar stock
        $producto->stock += $salida->cantidad;
        $producto->save();

        $salida->delete();

        return redirect()->route('salidas.index')
            ->with('success', 'Salida eliminada');
    }
}