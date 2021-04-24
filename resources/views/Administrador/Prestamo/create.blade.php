@extends('layouts.app')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("prestamo.store") }}" method="POST" enctype="multipart/form-data">
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
                        <label for="creacion">Fecha de prestamo</label>
                        <input class="form-control" type="date" name="creacion" id="creacion">
                    </div>

                    <div class="form-group">
                        <label for="devolucion">Fecha de devolución</label>
                        <input class="form-control" type="date" name="devolucion" id="devolucion">
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            @foreach ($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <select class="form-control" name="libro_id" id="libro_id">
                            @foreach ($libros as $libro)
                                <option value="{{$libro->id}}">{{$libro->titulo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('prestamo.index') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>
</form>

@endsection