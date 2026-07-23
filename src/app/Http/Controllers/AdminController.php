<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cotizacion;

class AdminController extends Controller
{
    public function index(){
        $user = User::all()->count();
         $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')
        ->count();

        return view('admin.dashboard',compact('user', 'cotizacionesPendientes'));
    }
}
