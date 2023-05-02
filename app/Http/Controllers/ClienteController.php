<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('tables.clientes', ['clientes' => $clientes]);
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
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);
        if ($validator->fails())
            abort(404);
        $cliente = Cliente::find($id);
        if ($cliente == null) {
            abort(404);
        }
        $compras = $cliente->compras;

        return view('tables.cliente_compras', ['cliente' => $cliente, 'compras' => $compras]);
    }

    public function getComprasByClienteAPI(string $id)
    {
        $validator = Validator::make(['id' => $id], ['id' => 'integer',]);

        if ($validator->fails()) {
            return response('El ID del cliente tiene que ser un valor entero', 400);
        }

        $cliente = Cliente::find($id);
        if ($cliente == null) {
            return response('No existe cliente con ID ' . $id, 404);
        }
        $compras = $cliente->compras;

        foreach ($compras as $compra) {
            $compra->pedidos->toJson();
        }

        return response()->json($compras);
        ;
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