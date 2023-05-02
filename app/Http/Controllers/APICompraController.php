<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Camiseta;
use App\Models\Compra;
use App\Models\Pedido;
use Illuminate\Support\Facades\Validator;


class APICompraController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
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

    public function getComprasByCliente(string $email)
    {
        $validator = Validator::make(['email' => $email], ['email' => 'required|email',]);

        if ($validator->fails()) {
            return response('Se requiere un email válido', 400);
        }

        $cliente = Cliente::where('email', $email)->first();
        if ($cliente == null) {
            return response('No existe cliente con email ' . $email, 404);
        }
        $compras = $cliente->compras;

        foreach ($compras as $compra) {
            foreach($compra->pedidos as $pedido){
                $pedido->camiseta_id = Camiseta::where('id',$pedido->camiseta_id)->first()->nombre;
            }
            $compra->pedidos->toJson();
        }

        return response()->json($compras);
    }

    public function createCompra()
    {
        // TO DO
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
