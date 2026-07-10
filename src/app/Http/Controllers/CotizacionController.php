<?php

namespace App\Http\Controllers;


use App\Models\Cotizacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
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
}
