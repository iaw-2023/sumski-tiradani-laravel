<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camiseta;
use App\Models\Categoria;
use App\Models\RelacionCamisetaCategoria;

class CamisetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camisetas = Camiseta::all();

        foreach ($camisetas as $camiseta) {
            // loading images
            $updatedDate = str_replace(':', '-', $camiseta->updated_at);
            $updatedDate = str_replace(' ', '_', $updatedDate);

            $image_route = "images/".$camiseta->id."frente_".$updatedDate.".jpg";
            if(!file_exists($image_route)){
                $image = base64_decode(stream_get_contents($camiseta->imagen_frente));
                $file = fopen($image_route, "w");
                fwrite($file, $image);
                fclose($file);
            }

            $image_route = "images/".$camiseta->id."atras_".$updatedDate.".jpg";
            if(!file_exists($image_route)){
                $image = base64_decode(stream_get_contents($camiseta->imagen_atras));
                $file = fopen($image_route, "w");
                fwrite($file, $image);
                fclose($file);
            }

            // fetching categories names from remera-categoria relation
            $categoriesName = array();
            foreach($camiseta->categorias as $category){
                array_push($categoriesName, $category->name);
            }

            $camiseta->categorias = implode(', ', $categoriesName);
        }

        return view('tables.camisetas', ['camisetas' => $camisetas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create.camisetas');
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
