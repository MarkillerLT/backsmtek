<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
