<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cotizacion;
use App\Models\Postulacion;
use App\Models\Producto;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::count();

        $productos = Producto::count();

        $postulantes = Postulacion::where('estado', 'pendiente')->count();

        // Cotizaciones
        $pendientes = Cotizacion::where('estado', 'pendiente')->count();
        $enProceso = Cotizacion::where('estado', 'en_proceso')->count();
        $respondidas = Cotizacion::where('estado', 'respondida')->count();
        $cotizacionesRespondidas = $respondidas;
        $cotizacionesPendientes = $pendientes;

        // Productos por clasificación (para el bar chart horizontal)
        $clasificaciones = ['turck', 'banner', 'kubler', 'puls', 'otros'];

        $productoPorClasificacion = Producto::select(
                'clasificacion',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('clasificacion')
            ->pluck('total', 'clasificacion'); // clave => valor, listo para data_get

        $clasifData = collect($clasificaciones)->mapWithKeys(function ($clave) use ($productoPorClasificacion) {
            return [$clave => (int) data_get($productoPorClasificacion, $clave, 0)];
        });

        return view('admin.dashboard', compact(
            'user',
            'productos',
            'postulantes',
            'cotizacionesRespondidas',
            'cotizacionesPendientes',
            'pendientes',
            'enProceso',
            'respondidas',
            'clasifData'
        ));
    }
    public function usuarios()
    {
        $usuarios = User::orderBy('name')->get();

        $cotizacionesPendientes = \App\Models\Cotizacion::where(
            'estado',
            'pendiente'
        )->count();

        return view('admin.usuarios.index', compact(
            'usuarios',
            'cotizacionesPendientes'
        ));
    }

    public function cambiarRol(Request $request, User $user)
    {
        $request->validate([
            'rol' => 'required|in:admin,usuario',
        ]);

        // Un admin no puede quitarse sus propios permisos
        if ($user->id === auth()->id() && $request->rol !== 'admin') {
            return back()->with(
                'error',
                'No puedes quitarte tu propio rol de administrador.'
            );
        }

        $user->rol = $request->rol === 'admin' ? 'admin' : null;
        $user->save();

        return back()->with(
            'success',
            'El rol de ' . $user->name . ' fue actualizado correctamente.'
        );
    }
    public function perfil()
    {
        $cotizacionesPendientes = \App\Models\Cotizacion::where(
            'estado',
            'pendiente'
        )->count();

        return view('admin.perfil.index', compact(
            'cotizacionesPendientes'
        ));
    }

    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

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
