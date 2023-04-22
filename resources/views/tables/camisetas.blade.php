<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Datatables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

    <title>Camisetas</title>
  </head>
  <body>

    <table id="camisetasTable" class="display">
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
            <th class="nosort">Modificar</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($camisetas as $camiseta) 
          <tr>
              <td>{{$camiseta->id}}</td>
              <td>{{$camiseta->nombre}}</td>
              <td>{{$camiseta->descripcion}}</td>
              <td>${{$camiseta->precio}}</td>
              <td><img src="images/{{$camiseta->id}}frente_{{str_replace(' ', '_',str_replace(':', '-', $camiseta->updated_at))}}.jpg" width=150/></td>
              <td><img src="images/{{$camiseta->id}}atras_{{str_replace(' ', '_',str_replace(':', '-', $camiseta->updated_at))}}.jpg" width=150/></td>
              <td>{{$camiseta->talles_disponibles}}</td>
              @if ($camiseta->activo == 1)
                <td>✔️</td>
              @else
                <td>🚫</td>
              @endif
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Datatables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#camisetasTable').DataTable({
          'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
          }]
        });
      });
    </script>

  </body>
</html>
