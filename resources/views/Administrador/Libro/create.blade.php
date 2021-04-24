@extends('layouts.app')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("libro.store") }}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="row">
        <div class="col-lg-8 col-lg-8 col-md-8 col-sm-12 col-12  layout-spacing">
            <div class="statbox widget box box-shadow">
    
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h3></h3>
                            @if(\Session::get('Mensaje'))
                            <div class="alert alert-light-danger">
                                <p>{{\Session::get('Mensaje')}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
    
                <div class="widget-content widget-content-area">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" name="titulo" id="titulo" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="103" rows="5"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" name="autor" id="autor" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="disponible">Disponible</label>
                        <select class="form-control" name="disponible" id="disponible">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ejemplares">Cantidad de ejemplares</label>
                        <input class="form-control" type="number" name="ejemplares" id="ejemplares">
                    </div>

                    <div class="form-group">
                        <label for="estante">Estante</label>
                        <input class="form-control" type="text" name="estante" id="estante">
                    </div>

                    <div class="form-group">
                        <label for="fila">Fila</label>
                        <input class="form-control" type="number" name="fila" id="fila">
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('libro.index') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>
</form>

@endsection