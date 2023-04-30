<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camiseta;
use App\Models\Categoria;
use App\Models\RelacionCamisetaCategoria;
use Illuminate\Support\Facades\Validator;

class CamisetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camisetas = Camiseta::all();
        $camisetas = $this->loadImages($camisetas);
        return view('tables.camisetas', ['camisetas' => $camisetas]);
    }

    /**
     * Display a listing of the resource in a category
     */
    public function indexByCategory(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $categoria = Categoria::find($id);
            if ($categoria == null) {
                abort(404);
            }

            $camisetas = $categoria->camisetas;
            $camisetas = $this->loadImages($camisetas);
            return view('tables.camisetas', ['camisetas' => $camisetas, 'categoria' => $categoria]);
        } catch (ValidationException $e) {
            abort(404);
        }
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

            $image_route = "images/" . $camiseta->id . "atras_" . $updatedDate . ".jpg";
            if (!file_exists($image_route)) {
                $image = base64_decode(stream_get_contents($camiseta->imagen_atras));
                $file = fopen($image_route, "w");
                fwrite($file, $image);
                fclose($file);
            }
        }
        return $camisetas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all()->pluck('name');
        return view('create.new_camiseta', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $camiseta = new Camiseta();

        $camiseta->nombre = $request->get('nombre');
        $camiseta->descripcion = $request->get('descripcion');
        $camiseta->precio = $request->get('precio');

        $talle_S = $request->get('botonS');
        $talle_M = $request->get('botonM');
        $talle_L = $request->get('botonL');
        $talle_XL = $request->get('botonXL');

        $talles = "";

        if ($talle_S)
            $talles .= "S, ";
        if ($talle_M)
            $talles .= "M, ";
        if ($talle_L)
            $talles .= "L, ";
        if ($talle_XL)
            $talles .= "XL, ";

        // Elimina la trailing comma
        $talles = substr($talles, 0, -2);
        $camiseta->talles_disponibles = $talles;

        $atras = $request->file('imagen_atras');
        $atras = base64_encode($atras->get());

        $frente = $request->file('imagen_frente');
        $frente = base64_encode($frente->get());

        $camiseta->imagen_frente = $frente;
        $camiseta->imagen_atras = $atras;

        $camiseta->save();

        // Categorias asignadas a la camiseta
        $categorias = $request->get('tags');
        $categorias_existentes = Categoria::all();
        $id_categorias = array();

        foreach ($categorias as $categoria) {
            foreach ($categorias_existentes as $categoria_existente) {
                if (!strcmp($categoria, $categoria_existente->name)) {
                    array_push($id_categorias, $categoria_existente->id);
                }
            }
        }

        foreach ($id_categorias as $id_categoria) {
            $camiseta->categorias()->attach($id_categoria);
        }

        return redirect('/camisetas')->with("success", "La camiseta " . $camiseta->nombre . ' fue creada con éxito');
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
        $camiseta = Camiseta::where('id', $id)->first();
        $categorias = Categoria::all()->pluck('name');
        return view('create.edit_camiseta', ['camiseta' => $camiseta, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $camiseta = Camiseta::where('id', $id)->first();
        $camiseta->save();

        $categorias_existentes = Categoria::all();

        $camiseta->nombre = $request->get('nombre');
        $camiseta->descripcion = $request->get('descripcion');
        $camiseta->precio = $request->get('precio');
        $camiseta->save();

        $talle_S = $request->get('botonS');
        $talle_M = $request->get('botonM');
        $talle_L = $request->get('botonL');
        $talle_XL = $request->get('botonXL');

        $talles = "";

        if ($talle_S)
            $talles .= "S, ";
        if ($talle_M)
            $talles .= "M, ";
        if ($talle_L)
            $talles .= "L, ";
        if ($talle_XL)
            $talles .= "XL, ";

        // Elimina la trailing comma
        $talles = substr($talles, 0, -2);
        $camiseta->talles_disponibles = $talles;

        $camiseta->save();

        $atras = $request->file('imagen_atras');
        $frente = $request->file('imagen_frente');

        if ($atras != null) {
            $atras = base64_encode($atras->get());
            $camiseta->imagen_atras = $atras;
        }

        if ($frente != null) {
            $frente = base64_encode($frente->get());
            $camiseta->imagen_frente = $frente;
        }

        //$camiseta()->save();

        $categorias_old = RelacionCamisetaCategoria::where('camiseta_id', $id);
        $categorias_new = $request->get('tags');

        $id_categorias_new = array();

        foreach ($categorias_new as $categoria_new) {
            foreach ($categorias_existentes as $categoria_existente) {
                if (!strcmp($categoria_new, $categoria_existente->name)) {
                    array_push($id_categorias_new, $categoria_existente->id);
                }
            }
        }

        foreach ($categorias_old as $categoria_old) {
            $camiseta->categorias()->detach($categoria_old);
        }

        foreach ($id_categorias_new as $id_categoria_new) {
            $camiseta->categorias()->attach($id_categoria_new);
        }

        return redirect('/camisetas')->with("success", "La camiseta " . $camiseta->nombre . ' fue actualizada con éxito');
        //return redirect()->back()->with("success", "La camiseta '" . $camiseta->nombre . "' fue actualizada con éxito");
    }

    /**
     * Update the Activo column that represents stock
     */
    public function updateStock(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $camiseta = Camiseta::find($id);


            if ($camiseta == null) {

                abort(404);
            }

            $nuevo = 0;
            if ($camiseta->activo == 0)
                $nuevo = 1;

            $camiseta->activo = $nuevo;
            $camiseta->update();

            return redirect('/camisetas')->with("success", "El stock de la camiseta '" . $camiseta->nombre . "' fue actualizado con éxito");
        } catch (ValidationException $e) {
            abort(404);
        }
    }

    /**
     * Show the delete confirmation
     */
    public function delete(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $camiseta = Camiseta::find($id);
            if ($camiseta == null) {
                abort(404);
            }

            return view('edit.delete_camiseta', ['camiseta' => $camiseta]);
        } catch (ValidationException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $camiseta = Camiseta::find($id);


            if ($camiseta == null) {
                abort(404);
            }

            $nombre = $camiseta->nombre;
            $camiseta->delete();
            return redirect('/camisetas')->with("deleted", "La camiseta '" . $nombre . "' fue eliminada con éxito");
        } catch (ValidationException $e) {
            abort(404);
        }
    }
}