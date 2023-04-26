@extends('layouts.app')

@section('content')
    {{-- ver si se queda --}}
    <div class="bg-white shadow p-3 rounded-lg"> 
        <h1>Nueva camiseta</h1>
  
        <form>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            <label for="exampleInputEmail1">Descripción</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                            
                            <label for="exampleInputEmail1">Precio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            
                        
                            
                            <br>
                            <label for="btn-group">Talles disponibles</label>
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck1">S</label>

                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck2">M</label>

                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck3">L</label>

                                <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck4">XL</label>

                                <div class="btn-group-toggle ml-3" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                    <input type="checkbox" checked autocomplete="off"> Activa </label>
                                </div>
                            </div>

        <br><br>
                            <button type="submit" class="btn btn-primary">Submit</button>


                        </div>
                    </div>
                    <div class="col-3 text-center my-auto">
                        <img src="..." class="img-thumbnail" alt="...">
                        <button type="button" class="btn btn-outline-primary align-middle">Imagen frente</button>
                    </div>                
                    <div class="col-3 text-center my-auto">
                        <img src="..." class="img-thumbnail" alt="...">
                        <button type="button" class="btn btn-outline-primary">Imagen atras</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
@endsection
