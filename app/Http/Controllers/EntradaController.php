<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    //  LISTA
    public function index()
    {
        $entradas = Entrada::with('producto')->get();
        return view('entradas.index', compact('entradas'));
    }

    //  FORM
    public function create()
    {
        $productos = Producto::all();
        return view('entradas.create', compact('productos'));
    }

    //  GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'orden_compra' => 'required',
            'fecha_orden' => 'required|date',
            'fecha_ingreso' => 'required|date',
        ]);

        Entrada::create($request->all());

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada registrada');
    }

    //  EDIT
    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        $productos = Producto::all();

        return view('entradas.edit', compact('entrada', 'productos'));
    }

    //  UPDATE
    public function update(Request $request, $id)
    {
        $entrada = Entrada::findOrFail($id);

        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'orden_compra' => 'required',
            'fecha_orden' => 'required|date',
            'fecha_ingreso' => 'required|date',
        ]);

        $entrada->update($request->all());

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada actualizada');
    }

    // DELETE
    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada eliminada');
    }
}