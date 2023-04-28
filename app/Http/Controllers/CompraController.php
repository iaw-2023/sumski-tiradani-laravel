<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Compra;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::all();
        return view('tables.compras', ['compras' => $compras]);
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
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $compra = Compra::find($id);
            if($compra == null){
                abort(404);
            }

            $pedidos = $compra->pedidos ;
            return view('tables.compra_pedidos', ['compra' => $compra, 'pedidos' => $pedidos]);
        } catch (ValidationException $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $compra = Compra::find($id);
            if($compra == null){
                abort(404);
            }

            return view('edit.edit_compra', ['compra' => $compra]);
        } catch (ValidationException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = Validator::make(['id' => $id], ['id' => 'integer',])->validate();

            $compra = Compra::find($id);
            if($compra == null){
                abort(404);
            }

            $request->validate([
                'estado' => [
                    'required',
                    'string',
                    Rule::in(['Entregado', 'En viaje', 'En preparacion', 'Esperando pago', 'Cancelado'])
                ]
            ]);

            $compra->estado = $request->estado;
            $compra->update();

            return redirect("/compras/".$id)->with("success", "La compra ".$id." de ".$compra->cliente->email." fue actualizada correctamente.");
        } catch (ValidationException $e) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
