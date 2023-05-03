<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Camiseta;
use App\Models\Compra;
use App\Models\Pedido;
use Illuminate\Validation\Rule;
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
        $request->validate(
            [
                'cliente' => ['required', 'email'],
                'forma_de_pago' => ['required', 'string'],
                'direccion_de_entrega' => ['required', 'string'],
                'pedidos' => ['required', 'array','min:1'],
                'pedidos.*.nombre_camiseta' => ['required', 'regex:/^[a-zA-Z0-9\s\/]+$/', Rule::exists('camisetas', 'nombre')->where('activo',1)],
                'pedidos.*.nombre_a_estampar' => ['required','regex:/^[a-zA-Z\s]+$/'],
                'pedidos.*.numero_a_estampar' => ['required','regex:/^[0-9]+$/'],
                'pedidos.*.talle_elegido' => ['required']
            ],
            [
                'cliente' => 'Es necesario completar con cliente: <email_valido>, puede ser usuario nuevo o existente',
                'forma_de_pago' => 'Es necesario completar con forma_de_pago: <detalles pago>',
                'direccion_de_entrega' => 'Es necesario completar con direccion_de_entrega: <direccion>',
                'pedidos' => 'Es necesaria una lista de pedidos',
                'pedidos.*.nombre_camiseta' => 'Un pedido debe contener un nombre_camiseta: valido, no eliminado y en stock',
                'pedidos.*.nombre_a_estampar' => 'Un pedido debe contener un nombre_camiseta: valido, solo letras y espacios',
                'pedidos.*.numero_a_estampar' => 'Un pedido debe contener un nombre_camiseta: valido, solo numeros',
                'pedidos.*.talle_elegido' => 'Un pedido debe contener un talle_elegido: valido y disponible',
            ]
        );

        $pedidos = $request->get('pedidos');
        foreach ($pedidos as $pedido) { // Validamos talle a mano por tenerlos guardados como String
            $camisetaTalles = Camiseta::where('nombre', $pedido['nombre_camiseta'])->first()->talles_disponibles;
            if (!preg_match("~\b".$pedido['talle_elegido']."\b~", $camisetaTalles)){
                return response("Un pedido debe contener un talle_elegido existente para la camiseta elegida",422);
            }
        }

        $compra = new Compra();

        $mail = $request->get('cliente');
        $comprador = Cliente::where('email', $mail)->first();
        if ($comprador == null) {
            $comprador = new Cliente();
            $comprador->email = $mail;
            $comprador->save();
        }

        $compra->forma_de_pago = $request->get('forma_de_pago');
        $compra->direccion_de_entrega = $request->get('direccion_de_entrega');
        $compra->precio_total = 0;
        $compra->estado = "Esperando pago";
        
        $comprador->compras()->save($compra); // Asocia el cliente (nuevo o existente) con la compra

        $precio_total = 0;
        foreach($pedidos as $pedido){
            $pedido_asociado = new Pedido();
            $camiseta = Camiseta::where('nombre', $pedido['nombre_camiseta'])->first();
            $pedido_asociado->camiseta_id = $camiseta->id;
            $pedido_asociado->nombre_a_estampar = $pedido['nombre_a_estampar'];
            $pedido_asociado->numero_a_estampar = $pedido['numero_a_estampar'];
            $pedido_asociado->talle_elegido = $pedido['talle_elegido'];
            $pedido_asociado->precio = $camiseta->precio;
            $precio_total += $camiseta->precio;

            $compra->pedidos()->save($pedido_asociado); // Asocia el pedido con la compra
        }

        $compra->precio_total = $precio_total; // Reescribe el precio con el total
        $compra->save();

        return response("Compra realizada con exito", 200);
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
