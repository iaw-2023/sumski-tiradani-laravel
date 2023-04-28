<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('tables.categorias', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the delete confirmation
     */
    public function delete(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $categoria = Categoria::find($id);
            if($categoria == null){
                abort(404);
            }
            
            return view('edit.delete_categoria', ['categoria' => $categoria]);
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

            $categoria = Categoria::find($id);
            if($categoria == null){
                abort(404);
            }
            $nombre = $categoria->name;

            $categoria->camisetas()->detach(); // Borra la relacion camiseta_categoria para todas las camisetas asociadas a esta categoria
            $categoria->delete();
            
            return redirect('/categorias')->with("deleted", "La categoría ".$nombre.' fue eliminada con éxito');
        } catch (ValidationException $e) {
            abort(404);
        }
    }
}
