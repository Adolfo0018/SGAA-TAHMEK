@extends('layouts.app')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("devolucion.update",$devolucion->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
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
                        <label for="devolucion">Fecha de devolución</label>
                        <input class="form-control" type="date" name="devolucion" id="devolucion" value="{{$devolucion->devolucion}}">
                    </div>

                    <div class="form-group">
                        <label for="usuario_id">Usuario</label>
                        <select class="form-control" name="usuario_id" id="usuario_id">
                            
                            @foreach ($usuarios as $usuario)
                                @if ($devolucion->usuario->id == $usuario->id)
                                    <option selected value="{{$devolucion->usuario->id}}">{{$devolucion->usuario->name}}</option>
                                @else
                                    <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="libro_id">Libro</label>
                        <select class="form-control" name="libro_id" id="libro_id">
                            @foreach ($libros as $libro)
                                @if ($devolucion->libro->id == $libro->id)
                                    <option selected value="{{$devolucion->libro->id}}">{{$devolucion->libro->titulo}}</option>
                                @else
                                    <option value="{{$libro->id}}">{{$libro->titulo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('devolucion.index') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>

</form>

@endsection