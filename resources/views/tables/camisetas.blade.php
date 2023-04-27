@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
      @if (isset($categoria))
        <h1>Camisetas de {{$categoria->name}}</h1>
        <hr>
      @else
        <h1>Camisetas</h1>
        <hr>
        <a href="/camisetas/nuevo" type="button" class="btn btn-success my-3">Nueva Camiseta</a><br>
      @endif
      <table id="camisetasTable" class="display" style="width: 100%">
        <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th class="nosort">Descripción</th>
              <th>Precio</th>
              <th class="nosort">Frente</th>
              <th class="nosort">Atras</th>
              <th>Talles Disponibles</th>
              <th>Activo</th>
              <th class="nosort">Categorías</th>
              <th class="nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($camisetas as $camiseta) 
            <tr>
                <td>{{$camiseta->id}}</td>
                <td>{{$camiseta->nombre}}</td>
                <td>{{mb_strimwidth($camiseta->descripcion, 0, 40, "...")}}</td>
                <td>${{number_format($camiseta->precio,2)}}</td>
                <td><img src="/images/{{$camiseta->id}}frente_{{str_replace(' ', '_',str_replace(':', '-', $camiseta->updated_at))}}.jpg" width=100/></td>
                <td><img src="/images/{{$camiseta->id}}atras_{{str_replace(' ', '_',str_replace(':', '-', $camiseta->updated_at))}}.jpg" width=100/></td>
                <td>{{$camiseta->talles_disponibles}}</td>
                @if ($camiseta->activo == 1)
                  <td>✅</td>
                @else
                  <td>🚫</td>
                @endif
                <td>
                  @php
                    $categoriesName = array();
                    foreach($camiseta->categorias as $category){
                      array_push($categoriesName, $category->name);
                    }
                    $categorias = implode(', ', $categoriesName);
                  @endphp
                  {{mb_strimwidth($categorias, 0, 40, "...")}}
                </td>
                <td>
                  <span>
                    <button type="button" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
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
        $('#camisetasTable').DataTable({
          'lengthMenu': [5, 10, 20, 50],
          'responsive': true,
          'columnDefs': [
            { orderable: false, targets: [2,4,5,8,9] }
          ],
          "columnDefs": [
            { "width": "15%", "targets": [1] },
            { "width": "15%", "targets": [2] },
            { "width": "6%", "targets": [4,5] },
            { "width": "10%", "targets": [6] },
            { "width": "5%", "targets": [7] },
          ]
        });
        $(".dataTables_length select").addClass("px-4");
      });
    </script>
@endsection
