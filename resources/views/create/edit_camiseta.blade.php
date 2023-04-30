@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Editar camiseta</h1>
        <hr>
        <form action="/camisetas/{{$camiseta->id}}/edit" method="POST">
            @csrf
            @method('PATCH')
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" >
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" value="{{old('nombre', $camiseta->nombre)}}" class="form-control" id="nombre" aria-describedby="emailHelp" >
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" value="{{old('descripcion', $camiseta->descripcion)}}" id="descripcion" aria-describedby="emailHelp" >
                            
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="precio">$</span>
                                </div>
                                <input type="text" class="form-control" name="precio" value="{{old('precio', $camiseta->precio)}}" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>     
                            <br>
                            <label for="btn-group">Talles disponibles</label>
                            <br>
                            <div class="btn-group " role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" name="botonS" id="btncheck1" autocomplete="off" @if(str_contains($camiseta->talles_disponibles, "S")) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck1">S</label>

                                <input type="checkbox" class="btn-check" name="botonM" id="btncheck2" autocomplete="off" @if(str_contains($camiseta->talles_disponibles, "M")) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck2">M</label>

                                <input type="checkbox" class="btn-check" name="botonL" id="btncheck3" autocomplete="off" @if(preg_match("~\bL\b~", $camiseta->talles_disponibles)) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck3">L</label>

                                <input type="checkbox" class="btn-check " name="botonXL" id="btncheck4" autocomplete="off" @if(str_contains($camiseta->talles_disponibles, "XL")) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck4">XL</label>

                                <div class="btn-group-toggle " data-toggle="buttons">
                                </div>
                            </div>
        <br><br>
                            <label for="tags">Tags:</label>
                            <select id="tags" name="tags[]" multiple>
                                @foreach ($categorias as $tag)
                                    $tag = str_replace('\u00f1','ñ',$tag);
                                    $tag = str_replace('\u00d1','Ñ',$tag); 
                                    <option value="{{ $tag }}" @if($camiseta->categorias->contains('name', $tag)) selected @endif>{{ $tag }}</option>
                                @endforeach
                            </select>
        <br>
                            <button type="submit" class="btn btn-outline-success">Actualizar camiseta</button>
                            <a href="/camisetas" class="btn btn-outline-danger" role="button" aria-disabled="true">Cancelar</a>


                        </div>
                    </div>
                    <div class="col-6"> 
                    <br>
                        <span class="label label-info">En caso de no cargar imagenes no se actualizaran las anteriores</span>
                        <div class="row ">
                            <label class="fs-4 form-label">Imagen frente</label>
                            <input type="file" name="imagen_frente" id="imagen_frente" enctype="multipart/form-data">
                        </div>    
                        <br> <br>            
                        <div class="row pt-5 ">
                            <label class="fs-4 form-label">Imagen atras</label>
                            <input type="file" name="imagen_atras" id="imagen_atras" enctype="multipart/form-data">
                        </div>
                    <div>
                </div>
            </div>
        </form>
    </div>


    <script>
        $('#tags').selectize({
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });
    </script>
    
@endsection
