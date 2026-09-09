<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $cotizacionesHechas = Cotizacion::where('user_id', $user->id)->count();

        $cotizacionesRespondidas = Cotizacion::where('user_id', $user->id)
            ->where('estado', 'respondida')
            ->count();

        $cotizacionesPendientes = Cotizacion::where('user_id', $user->id)
            ->where('estado', 'pendiente')
            ->count();

        $cotizacionesEnProceso = Cotizacion::where('user_id', $user->id)
            ->where('estado', 'en_proceso')
            ->count();

        return view('user.dashboard', compact(
            'user',
            'cotizacionesHechas',
            'cotizacionesRespondidas',
            'cotizacionesPendientes',
            'cotizacionesEnProceso'
        ));
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $user->updateProfilePhoto($request->file('photo'));
        }

        $user->save();

        return back()->with(
            'success',
            'Tu perfil se actualizó correctamente.'
        );
    }
}
