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
     * @OA\Get(
     * path="/_api/compras/{email}",
     * tags={"Compras"},
     * summary="Retorna todas las compras con sus pedidos que pertenezcan a un cliente",
     * @OA\Parameter(
     *      name="email",
     *      in="path",
     *      description="Email de cliente del cual recuperar sus compras",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      )
     * ),
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/Compra")           
     *      )
     * ),
     * @OA\Response(
     *      response=422,
     *      description="Error: Unprocessable Content",
     *      @OA\MediaType(
     *          mediaType="text/html",
     *          example="No existe cliente con email holanoexisto@ea.com"
     *      )   
     * )
     * )
     */
    public function getComprasByCliente(string $email)
    {
        $validator = Validator::make(['email' => $email], ['email' => 'required|email',]);

        if ($validator->fails()) {
            return response('Se requiere un email válido', 422);
        }

        $cliente = Cliente::where('email', $email)->first();
        if ($cliente == null) {
            return response('No existe cliente con email ' . $email, 422);
        }
        $compras = $cliente->compras;

        foreach ($compras as $compra) {
            foreach($compra->pedidos as $pedido){
                $pedido->camiseta_id = Camiseta::where('id',$pedido->camiseta_id)->withTrashed()->first()->nombre;
            }
            $compra->pedidos->setHidden(['id', 'compra_id', 'created_at', 'updated_at','pivot']);
            $compra->pedidos->toJson();
        }

        $compras->setHidden(['id', 'cliente_id', 'created_at', 'updated_at']);
        return response()->json($compras);
    }

    /**
     * @OA\Post(
     * path="/_api/comprar",
     * summary="Realiza una compra con sus pedidos",
     * tags={"Compras"},
     * @OA\RequestBody(
     *     required = true,
     *     @OA\JsonContent(
     *          required={"cliente","forma_de_pago","direccion_de_entrega","pedidos"},
     *          @OA\Property(property="cliente",type="string",example="ematiradani@gmail.com"),
     *          @OA\Property(property="forma_de_pago",type="string",example="Tarjeta Visa"),
     *          @OA\Property(property="direccion_de_entrega",type="string",example="Av Alem y San Juan"),
     *          @OA\Property(property="pedidos",type="array",
     *              @OA\Items(
     *                  type="object",
     *                  @OA\Property(property="nombre_camiseta",type="string",example="Camiseta Titular Boca"),
     *                  @OA\Property(property="nombre_a_estampar",type="string",example="Ema"),
     *                  @OA\Property(property="numero_a_estampar",type="string",example="10"),
     *                  @OA\Property(property="talle_elegido",type="string",example="S")
     *              )
     *          )
     *     )
     * ),
     * @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(
     *      type="string",
     *      example="Compra realizada con éxito"          
     *      )
     * ),
     * @OA\Response(
     *      response=422,
     *      description="Error: Unprocessable Content",
     *      @OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="message",type="string",example="Un pedido debe contener un nombre_camiseta: valido, no eliminado y en stock") ,
     *          @OA\Property(property="errors",type="object", example="cliente: [mensajes de error en parametro cliente], forma_de_pago: [mensajes de error...]...")      
     *      )   
     * )
     * )
     */
    public function createCompra(Request $request)
    {
        $request->validate(
            [
                'cliente' => ['required', 'email'],
                'forma_de_pago' => ['required', 'string'],
                'direccion_de_entrega' => ['required', 'string'],
                'pedidos' => ['required', 'array','min:1'],
                'pedidos.*.nombre_camiseta' => ['required', 'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s\/]+$/', Rule::exists('camisetas', 'nombre')->where('activo',1)],
                'pedidos.*.nombre_a_estampar' => ['required','regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'],
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
    
}
