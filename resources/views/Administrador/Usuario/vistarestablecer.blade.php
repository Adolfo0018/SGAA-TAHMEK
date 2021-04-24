@extends('layouts.app')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("usuario.restablecer", $usuarios->id) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="nombre">Restablecer la contraseña para el usuario {{$usuarios->name}} {{$usuarios->lastname}}</label>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Nueva contraseña</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('usuario.index') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>

</form>

@endsection