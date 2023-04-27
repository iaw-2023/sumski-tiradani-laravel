@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Compra Código {{$compra->id}}</h1>
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
        <br>
        Estado: {{ $compra->estado }}
        <br><br>
        <a type="button" class="btn btn-warning">Actualizar estado</a>
      </div>
      @include('components.alert.success')
      <hr>
      <div>
        <h3>Detalle con todos los pedidos</h3><br>
        <table id="pedidosTable" class="display" style="width: 100%">
        <thead>
            <tr>
              <th>Cód Producto</th>
              <th>Nombre Producto</th>
              <th>Nombre a Estampar</th>
              <th>Numero a Estampar</th>
              <th>Talle Elegido</th>
              <th>Precio Unitario</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($pedidos as $pedido) 
            <tr>
              <td>{{ $pedido->camiseta->id }}</td>
              <td>{{ $pedido->camiseta->nombre }}</td>
              <td>{{ $pedido->nombre_a_estampar }}</td>
              <td>{{ $pedido->numero_a_estampar }}</td>
              <td>{{ $pedido->talle_elegido }}</td>
              <td>{{ "$".number_format($pedido->precio,2) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>

    </div>

    <!-- Datatables JS -->
    <script>
      $(document).ready(function () {
        $('#pedidosTable').DataTable({  
          'responsive': true,
          'columnDefs': [
            { orderable: false, targets: [] }
          ],
          "columnDefs": [
            { "width": "15%", "targets": [] }
          ]
        });
        $(".dataTables_length select").addClass("px-4");
      });
    </script>
@endsection
