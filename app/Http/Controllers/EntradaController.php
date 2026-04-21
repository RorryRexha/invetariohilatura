<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Exports\EntradasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // 🔹 Generar folio antes de guardar
    $ultimo = Entrada::latest()->first();
    $num = $ultimo ? $ultimo->id + 1 : 1;

    $folio = 'ENT-' . str_pad($num, 6, '0', STR_PAD_LEFT);

    // 🔹 Guardar entrada
    Entrada::create([
        'producto_id' => $request->producto_id,
        'cantidad' => $request->cantidad,
        'orden_compra' => $request->orden_compra,
        'fecha_orden' => $request->fecha_orden,
        'fecha_ingreso' => $request->fecha_ingreso,
        'folio' => $folio
    ]);

    return redirect()->route('entradas.index')
        ->with('success', 'Entrada registrada con folio ' . $folio);
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


    public function exportExcel()
    {
         return Excel::download(new EntradasExport, 'entradas.xlsx');
    }

    public function exportPDF()
    {
         $entradas = Entrada::with('producto')->get();

         $pdf = Pdf::loadView('entradas.pdf', compact('entradas'));

         return $pdf->stream('reporte_entradas.pdf');
    }


    public function show($id)
    {
        //
    }
}