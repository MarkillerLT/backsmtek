<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulacion;

class PostulacionController extends Controller
{
    public function create(){
        return view('postulaciones.create');
    }

public function store(Request $request){
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
}
