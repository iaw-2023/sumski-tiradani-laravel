@extends('layouts.app')

@section('content')
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Nueva camiseta</h1>
        <hr>
        <form action="/camisetas/new" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group" >
                            <div class="form-floating mb-3">
                                
                                <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" id="nombre" placeholder="name@example.com">
                                <label for="nombre">Nombre</label>
                            </div>
                            @error('nombre')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}" id="descripcion" placeholder="name@example.com">
                                <label for="descripcion">Descripción</label>
                            </div>
                                @error('descripcion')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            
                            <label for="exampleInputEmail1">Precio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control" name="precio" value="{{old('precio')}}" aria-label="Amount (to the nearest dollar)">
                                @error('precio')
                                <div class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 

                            <label for="btn-group">Talles disponibles</label>
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" name="talles[]" value="S" id="btncheck1" @if((old('talles') != null) && (in_array('S', old('talles'), true))) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck1">S</label>

                                <input type="checkbox" class="btn-check" name="talles[]" value="M" id="btncheck2" @if((old('talles') != null) && (in_array('M', old('talles'), true))) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck2">M</label>

                                <input type="checkbox" class="btn-check" name="talles[]" value="L" id="btncheck3" @if((old('talles') != null) && (in_array('L', old('talles'), true))) checked @endif>
                                <label class="btn btn-outline-primary" for="btncheck3">L</label>

                                <input type="checkbox" class="btn-check " name="talles[]" value="XL" id="btncheck4" @if((old('talles') != null) && (in_array('XL', old('talles'), true))) checked @endif >
                                <label class="btn btn-outline-primary" for="btncheck4">XL </label>

                                <div class="btn-group-toggle " data-toggle="buttons">
                                </div>
                            </div>
                            @error('talles')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
							
        					<br><br>
                            <label for="tags">Tags:</label>
                            <select id="tags" name="tags[]" multiple>
                                @foreach ($categorias as $tag)
                                    $tag = str_replace('\u00f1','ñ',$tag);
                                    $tag = str_replace('\u00d1','Ñ',$tag); 
                                    <option value="{{ $tag }}" @if((old('tags') != null) && (in_array($tag, old('tags'), true))) selected @endif>{{ $tag }}</option>
                                @endforeach
                                @if((old('tags') != null))
                                    @foreach (old('tags') as $tag)
                                        <option value="{{ $tag }}" @if(!(in_array($tag, $categorias->toArray(), true))) selected @endif>{{ $tag }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('tags')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('tags.*')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror

        					<br>
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                            <a href="/camisetas" class="btn btn-outline-danger" role="button" aria-disabled="true">Cancelar</a>
                        </div>
                    </div>
                    <div class="col-6"> 
                    	<br>
                        <div class="row ">
                            <label class="fs-4 form-label">Imagen frente</label>
                            <input type="file" name="imagen_frente" id="imagen_frente">
                            @error('imagen_frente')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>    
                        <br><br>            
                        <div class="row pt-5 ">
                            <label class="fs-4 form-label">Imagen atras</label>
                            <input type="file" name="imagen_atras" id="imagen_atras">
                            @error('imagen_atras')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
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
