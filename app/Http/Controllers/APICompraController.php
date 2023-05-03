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

    public function createCompra(Request $request)
    {
        
        $compra = new Compra();
        $comprador = $request->get('cliente');
        echo $comprador;
        dd();
        $compra->forma_de_pago = $request->get('forma_de_pago');
        $compra->direccion_de_entrega = $request->get('direccion_de_entrega');
        
        
        $existe = Cliente::where('email', $comprador)->first();
        if ($existe == null) {
            //$existe = Cliente::create(['email'=>$comprador]);
            $existe = new Cliente();
            $existe->email = $comprador;
            $existe->save();
            $compra->cliente_id = $existe->id;
        }else{
            $compra->cliente_id = $existe->id;
        }
        

        $pedidos = $request->get(pedidos);

        $precio_total = 0;
        foreach($pedidos as $pedido){
            $pedido_asociado = new Pedido();
            $pedido_asociado->compra_id = $compra->id;
            $camiseta = Camiseta::where('nombre', $pedido->nombre_camiseta)->first();
            $pedido_asociado->camiseta_id = $camiseta->id;
            $pedido_asociado->nombre_a_estampar = $pedido->nombre_a_estampar;
            $pedido_asociado->numero_a_estampar = $pedido->numero_a_estampar;
            $pedido_asociado->talle_elegido = $pedido->talle_elegido;
            $pedido_asociado->precio = $camiseta->precio;
            $precio_total += $camiseta->precio;
            $pedido_asociado->save();
        }
        $compra->precio_total = $precio_total;
        $compra->estado = "Esperando pago";

        $compra->save();

        return response()->json($compra);
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
