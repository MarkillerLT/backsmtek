<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulacion;
use App\Models\Cotizacion;

class PostulacionController extends Controller
{
    public function create()
    {
        return view('postulaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|max:255',
            'correo'   => 'required|email|max:255',
            'telefono' => 'required|max:20',
            'puesto'   => 'nullable|max:255',
            'mensaje'  => 'nullable',
            'cv'       => 'required|file|mimes:pdf|max:5120',
        ]);

        $rutaCV = $request->file('cv')->store('cvs', 'public');

        Postulacion::create([
            'nombre'   => $request->nombre,
            'correo'   => $request->correo,
            'telefono' => $request->telefono,
            'puesto'   => $request->puesto,
            'mensaje'  => $request->mensaje,
            'cv'       => $rutaCV,
            'estado'   => 'recibido',
        ]);

        return redirect()
            ->route('postulacion.create')
            ->with('success', '¡Tu solicitud fue enviada correctamente!');
    }

    public function index()
    {
        $postulaciones = Postulacion::latest()->get();

        $estados = ['recibido', 'en_revision', 'aceptado', 'rechazado'];
        $resumen = collect($estados)->mapWithKeys(function ($estado) {
            return [$estado => Postulacion::where('estado', $estado)->count()];
        });

        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')->count();

        return view('admin.postulaciones.index', compact(
            'postulaciones',
            'resumen',
            'cotizacionesPendientes'
        ));
    }

    public function show($id)
    {
        $postulacion = Postulacion::findOrFail($id);

        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')->count();

        return view('admin.postulaciones.show', compact(
            'postulacion',
            'cotizacionesPendientes'
        ));
    }

    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:recibido,en_revision,aceptado,rechazado',
        ]);

        $postulacion = Postulacion::findOrFail($id);
        $postulacion->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado actualizado correctamente.');
    }
}
