@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Editando Compra Código {{$compra->id}}</h1>
      <hr><br>
      <div class="lead">
        <h3>Ticket</h3><br>
        E-mail: {{ $compra->cliente->email }}
        <br>
        Precio Total: {{ "$".number_format($compra->precio_total,2) }} 
        <br>
        Cantidad Items: {{ count($compra->pedidos) }}
        <br>
        Forma de pago: {{ $compra->forma_de_pago }} 
        <br>
        Dirección entrega: {{ $compra->direccion_de_entrega }}
        <br>
        Fecha y Hora de Compra: {{ $compra->fecha_hora }}
        <br><br>
        <form action="/compras/{{$compra->id}}/edit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <label for="estado">Seleccioná Estado:</label>
            <select id="estado" name="estado">
                <option value="Entregado" @if($compra->estado == "Entregado") selected @endif >Entregado</option>
                <option value="En viaje" @if($compra->estado == "En viaje") selected @endif>En viaje</option>
                <option value="En preparacion" @if($compra->estado == "En preparacion") selected @endif>En preparacion</option>
                <option value="Esperando pago" @if($compra->estado == "Esperando pago") selected @endif>Esperando pago</option>
                <option value="Cancelado" @if($compra->estado == "Cancelado") selected @endif>Cancelado</option>
            </select> 
            <br><br>
            <button type="submit" class="btn btn-outline-primary">Guardar</button>
        </form>
      </div>

    </div>

@endsection
