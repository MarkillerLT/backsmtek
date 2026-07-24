<?php

namespace App\Http\Controllers;


use App\Models\Cotizacion;
use Illuminate\Http\Request;

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
            'nombre'  => 'required|max:255',
            'empresa' => 'nullable|max:255',
            'correo'  => 'required|email|max:255',
            'telefono'=> 'required|max:10',
            'asunto'  => 'required|max:255',
            'mensaje' => 'required',
        ]);

        Cotizacion::create([
            'nombre'   => $request->nombre,
            'empresa'  => $request->empresa,
            'correo'   => $request->correo,
            'telefono' => $request->telefono,
            'asunto'   => $request->asunto,
            'mensaje'  => $request->mensaje,
            'estado'   => 'pendiente',
        ]);

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
            'estado' => [
                'required',
                'in:pendiente,en_proceso,respondida,cancelada'
            ],
        ]);

        $cotizacion->update([
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('admin.cotizaciones.show', $cotizacion)
            ->with('success', 'Estado actualizado correctamente.');
     }
}
