<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Cotizacion;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')
            ->count();
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.productos.create');
    }

    /**
     * S  tore a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'clasificacion' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $producto = new Producto();

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->clasificacion = $request->clasificacion;

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
            }

        $producto->save();

        return redirect()
            ->route('admin.productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
         return view('admin.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'clasificacion' => 'nullable|string|max:100',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->stock = $request->stock;
    $producto->clasificacion = $request->clasificacion;

    if ($request->hasFile('imagen')) {

        // Elimina la imagen anterior
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        // Guarda la nueva
        $producto->imagen = $request->file('imagen')->store('productos', 'public');
    }

    $producto->save();

    return redirect()
        ->route('admin.productos.index')
        ->with('success', 'Producto actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
{
    if ($producto->imagen) {
        Storage::disk('public')->delete($producto->imagen);
    }

    $producto->delete();

    return redirect()->route('admin.productos.index');
}
   }
