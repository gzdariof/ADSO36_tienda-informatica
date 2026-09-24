<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validar que cada archivo sea imagen y no supere los 300 KB (300 Kilobytes)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:300',
        ], [
            'imagenes.*.max' => 'Cada imagen no debe pesar más de 300 KB.',
            'imagenes.*.image' => 'El archivo subido debe ser una imagen válida.',
        ]);

        $imagenesBase64 = [];

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $mime = $file->getMimeType();
                $content = file_get_contents($file->getRealPath());
                $base64 = 'data:' . $mime . ';base64,' . base64_encode($content);
                $imagenesBase64[] = $base64;
            }
        }

        Producto::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagenes' => $imagenesBase64,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto registrado exitosamente.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
