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
            // loading images
            $updatedDate = str_replace(':', '-', $camiseta->updated_at);
            $updatedDate = str_replace(' ', '_', $updatedDate);

            $image_route = "images/" . $camiseta->id . "frente_" . $updatedDate . ".jpg";
            if (!file_exists($image_route)) {
                $image = base64_decode(stream_get_contents($camiseta->imagen_frente));
                $file = fopen($image_route, "w");
                fwrite($file, $image);
                fclose($file);
            }
            $camiseta->imagen_frente = "/" . $image_route;

            $image_route = "images/" . $camiseta->id . "atras_" . $updatedDate . ".jpg";
            if (!file_exists($image_route)) {
                $image = base64_decode(stream_get_contents($camiseta->imagen_atras));
                $file = fopen($image_route, "w");
                fwrite($file, $image);
                fclose($file);
            }
            $camiseta->imagen_atras = "/" . $image_route;
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
