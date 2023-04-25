<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camiseta;
use App\Models\Categoria;
use App\Models\RelacionCamisetaCategoria;
use App\Models\Pedidos;
use App\Models\Cliente;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camisetas = Camiseta::all();
        $pedidos = Pedidos::count();

        $activas = 0;
        $clientes_totales = Cliente::count();

        foreach($camisetas as $camiseta){
            if($camiseta->activo){
                $activas++;
            }
        }
    
    
        return view('home', ['camisetas' => $camisetas, 'pedidos' => $pedidos, 'activas'=>$activas, 'clientes'=>$clientes_totales]);
    }


}
