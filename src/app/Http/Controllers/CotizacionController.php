<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CotizacionesExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')
            ->count();

        $cotizaciones = Cotizacion::latest()->get();

        return view('admin.cotizaciones.index', compact(
            'cotizaciones',
            'cotizacionesPendientes'
        ));
    }

    public function create()
    {
        return view('cotizaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|max:255',
            'empresa'   => 'nullable|max:255',
            'correo'    => 'required|email|max:255',
            'telefono'  => 'required|max:10',
            'asunto'    => 'required|max:255',
            'mensaje'   => 'required',
            'localidad' => 'required|in:Queretaro,Silao,Toluca',
            'tipo_cotizacion'     => ['required', Rule::in(array_keys(Cotizacion::TIPOS))],
            'otro_especificacion' => ['nullable', 'required_if:tipo_cotizacion,otro', 'string', 'max:255'],
        ], [
            'tipo_cotizacion.required'        => 'Selecciona el tipo de cotización.',
            'tipo_cotizacion.in'              => 'Selecciona un tipo de cotización válido.',
            'otro_especificacion.required_if' => 'Especifica qué tipo de cotización necesitas.',
            'otro_especificacion.max'         => 'La especificación no debe superar los 255 caracteres.',
        ]);

        $esOtro = $request->tipo_cotizacion === 'otro';

        Cotizacion::create([
            'user_id'   => auth()->id(),
            'nombre'    => $request->nombre,
            'empresa'   => $request->empresa,
            'correo'    => $request->correo,
            'telefono'  => $request->telefono,
            'asunto'    => $request->asunto,
            'mensaje'   => $request->mensaje,
            'localidad' => $request->localidad,
            'tipo_cotizacion'     => $request->tipo_cotizacion,
            'otro_especificacion' => $esOtro ? trim($request->otro_especificacion) : null,
            'estado'    => 'pendiente',
            // numcontrol queda null: lo captura el vendedor desde el panel admin
        ]);
        if (auth()->check()) {
        return redirect()
            ->route('cotizaciones.mias')
            ->with('success', '¡Tu solicitud de cotización fue enviada correctamente!');
    }

        return redirect()
            ->route('cotizacion.create')
            ->with('success', '¡Tu solicitud de cotización fue enviada correctamente!');
    }

    public function show(Cotizacion $cotizacion)
    {
        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')
            ->count();

        return view('admin.cotizaciones.show', compact(
            'cotizacion',
            'cotizacionesPendientes'
        ));
    }

    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'estado'     => ['required', 'in:pendiente,en_proceso,respondida'],
            'numcontrol' => ['nullable', 'max:255'],
        ]);

        $cotizacion->update([
            'estado'     => $request->estado,
            'numcontrol' => $request->numcontrol,
        ]);

        return redirect()
            ->route('admin.cotizaciones.show', $cotizacion)
            ->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        $id = $cotizacion->id;

        $cotizacion->delete();

        return redirect()
            ->route('admin.cotizaciones.index')
            ->with('success', "Cotización #{$id} eliminada correctamente.");
    }

    public function exportExcel()
    {
        return Excel::download(new CotizacionesExport, 'cotizaciones.xlsx');
    }

    public function exportPdf()
    {
        $cotizaciones = Cotizacion::latest()->get();

        $pdf = Pdf::loadView('admin.cotizaciones.pdf', compact('cotizaciones'));

        return $pdf->download('cotizaciones.pdf');
    }
    public function misCotizaciones()
{
    $cotizaciones = Cotizacion::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('user.cotizaciones.index', compact('cotizaciones'));
}
}
