<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;
use App\Models\Camiseta;

class APICamisetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCamisetas()
    {
        $camisetas = Camiseta::all();
        $camisetas = $this->loadImages($camisetas);

        return response()->json($camisetas);
    }

    public function getCamisetasByCategoria(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);

        if ($validator->fails()) {
            return response('El ID de la categoría tiene que ser un valor entero', 400);
        }

        $categoria = Categoria::find($id);
        if ($categoria == null) {
            return response('No existe categoría con ID ' . $id, 404);
        }

        $camisetas = $categoria->camisetas;
        $camisetas = $this->loadImages($camisetas);

        return response()->json($camisetas);
    }

    private function loadImages($camisetas)
    {
        foreach ($camisetas as $camiseta) {
            $camiseta->imagen_frente = stream_get_contents($camiseta->imagen_frente);
            $camiseta->imagen_atras = stream_get_contents($camiseta->imagen_atras);
        }
        return $camisetas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
