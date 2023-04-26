@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
      <h1>Compras</h1>
      <br>
      <table id="comprasTable" class="display" style="width: 100%">
        <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Precio</th>
              <th>Cantidad items</th>
              <th>Forma de Pago</th>
              <th>Direccion</th>
              <th>Hora y Fecha</th>
              <th>Estado</th>
              <th class="nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($compras as $compra) 
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->cliente->email }}</td>
                <td>{{ $compra->precio_total }}</td>
                <td>{{ count($compra->pedidos) }}</td>
                <td>{{ $compra->forma_de_pago }}</td>
                <td>{{ $compra->direccion_de_entrega }}</td>
                <td>{{ $compra->fecha_hora }}</td>
                <td>{{ $compra->estado }}</td>
                <td>
                  <span>
                    <a type="button" href="compras/{{$compra->id}}" class="btn btn-primary">Ver detalle</a>
                  </span>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Datatables JS -->
    <script>
      $(document).ready(function () {
        $('#comprasTable').DataTable({
          'lengthMenu': [5, 10, 20, 50],
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