<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalidasExport;

class SalidaController extends Controller
{
    // LISTAR
    public function index()
    {
        $salidas = Salida::with('producto')->latest()->get();
        return view('salidas.index', compact('salidas'));
    }

    // FORM
    public function create()
    {
        $productos = Producto::all();
        return view('salidas.create', compact('productos'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:1',
            'fecha' => 'required|date',
        ]);

        $producto = Producto::with(['entradas', 'salidas'])
            ->findOrFail($request->producto_id);

        // 🔥 STOCK DINÁMICO
        $stockActual = $producto->entradas->sum('cantidad') 
                      - $producto->salidas->sum('cantidad');

        //  VALIDACIÓN
        if ($request->cantidad > $stockActual) {
            return back()
                ->with('error', 'No hay suficiente stock')
                ->withInput();
        }

        // GENERAR FOLIO
        $ultimo = Salida::latest('id')->first();
        $num = $ultimo ? $ultimo->id + 1 : 1;
        $folio = 'SAL-' . str_pad($num, 6, '0', STR_PAD_LEFT);

        // GUARDAR
        Salida::create([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
            'folio' => $folio
        ]);

        return redirect()->route('salidas.index')
            ->with('success', 'Salida registrada con folio ' . $folio);
    }

    // EDIT
    public function edit($id)
    {
        $salida = Salida::findOrFail($id);
        $productos = Producto::all();

        return view('salidas.edit', compact('salida', 'productos'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $salida = Salida::findOrFail($id);

        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:1',
            'fecha' => 'required|date',
        ]);

        $producto = Producto::with(['entradas', 'salidas'])
            ->findOrFail($request->producto_id);

        //  STOCK ACTUAL
        $stockActual = $producto->entradas->sum('cantidad') 
                      - $producto->salidas->sum('cantidad');

        // SUMAR LO ANTERIOR
        $stockDisponible = $stockActual + $salida->cantidad;

        // VALIDACIÓN
        if ($request->cantidad > $stockDisponible) {
            return back()
                ->with('error', 'Stock insuficiente')
                ->withInput();
        }

        //  ACTUALIZAR
        $salida->update([
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('salidas.index')
            ->with('success', 'Salida actualizada correctamente');
    }

    // DELETE
    public function destroy($id)
    {
        $salida = Salida::findOrFail($id);
        $salida->delete();

        return redirect()->route('salidas.index')
            ->with('success', 'Salida eliminada correctamente');
    }
    public function exportExcel()
    {
        return Excel::download(new SalidasExport, 'salidas.xlsx');
    }

    public function pdf()
    {
         $salidas = Salida::with('producto')->get();

         $pdf = Pdf::loadView('salidas.pdf', compact('salidas'));

         return $pdf->download('reporte_salidas.pdf');
    }

    public function show($id)
    {
        //
    }
}