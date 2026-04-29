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
    // ===============================
    // LISTADO
    // ===============================
    public function index(Request $request)
    {
        $query = Entrada::with('producto');

        if ($request->filled('search')) {
            $this->aplicarFiltro($query, $request->search);
        }

        $entradas = $query->orderBy('id', 'desc')->get();

        return view('entradas.index', compact('entradas'));
    }

    // ===============================
    // FORM CREAR
    // ===============================
    public function create()
    {
        $productos = Producto::orderBy('descripcion')->get();

        return view('entradas.create', compact('productos'));
    }

    // ===============================
    // GUARDAR
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'producto_id'   => 'required',
            'cantidad'      => 'required|numeric|min:1',
            'orden_compra'  => 'required',
            'fecha_orden'   => 'required|date',
            'fecha_ingreso' => 'required|date',
        ]);

        $ultimo = Entrada::latest('id')->first();
        $num = $ultimo ? $ultimo->id + 1 : 1;

        $folio = 'ENT-' . str_pad($num, 6, '0', STR_PAD_LEFT);

        Entrada::create([
            'producto_id'   => $request->producto_id,
            'cantidad'      => $request->cantidad,
            'orden_compra'  => strtoupper($request->orden_compra),
            'fecha_orden'   => $request->fecha_orden,
            'fecha_ingreso' => $request->fecha_ingreso,
            'folio'         => $folio,
        ]);

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada registrada con folio ' . $folio);
    }

    // ===============================
    // EDITAR
    // ===============================
    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        $productos = Producto::orderBy('descripcion')->get();

        return view('entradas.edit', compact('entrada', 'productos'));
    }

    // ===============================
    // ACTUALIZAR
    // ===============================
    public function update(Request $request, $id)
    {
        $entrada = Entrada::findOrFail($id);

        $request->validate([
            'producto_id'   => 'required',
            'cantidad'      => 'required|numeric|min:1',
            'orden_compra'  => 'required',
            'fecha_orden'   => 'required|date',
            'fecha_ingreso' => 'required|date',
        ]);

        $entrada->update([
            'producto_id'   => $request->producto_id,
            'cantidad'      => $request->cantidad,
            'orden_compra'  => strtoupper($request->orden_compra),
            'fecha_orden'   => $request->fecha_orden,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada actualizada');
    }

    // ===============================
    // ELIMINAR
    // ===============================
    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada eliminada');
    }

    // ===============================
    // EXPORTAR EXCEL
    // ===============================
    public function exportExcel(Request $request)
    {
        $query = Entrada::with('producto');

        if ($request->filled('search')) {
            $this->aplicarFiltro($query, $request->search);
        }

        $entradas = $query->orderBy('id', 'desc')->get();

        return Excel::download(
            new EntradasExport($entradas),
            'entradas.xlsx'
        );
    }

    // ===============================
    // EXPORTAR PDF
    // ===============================
    public function exportPDF(Request $request)
    {
        $query = Entrada::with('producto');

        if ($request->filled('search')) {
            $this->aplicarFiltro($query, $request->search);
        }

        $entradas = $query->orderBy('id', 'desc')->get();

        $pdf = Pdf::loadView('entradas.pdf', [
            'entradas' => $entradas
        ])->setPaper('A4', 'landscape');

        return $pdf->stream('reporte_entradas.pdf');
    }

    // ===============================
    // FILTRO GENERAL
    // ===============================
    private function aplicarFiltro($query, $search)
    {
        $search = trim($search);

        $query->where(function ($q) use ($search) {
            $q->where('folio', 'like', "%{$search}%")
              ->orWhere('orden_compra', 'like', "%{$search}%")
              ->orWhere('fecha_ingreso', 'like', "%{$search}%")
              ->orWhereHas('producto', function ($p) use ($search) {
                  $p->where('codigo', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
              });
        });
    }

    public function show($id)
    {
        //
    }
}