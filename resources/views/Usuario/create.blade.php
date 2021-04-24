@extends('layouts.appuser')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("solicitud.solicitar") }}" method="POST" enctype="multipart/form-data">
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
    
                <input type="hidden" name="usuario_id" id="usuario_id" value="{{ Auth::user()->id }}">

                <div class="widget-content widget-content-area">
                    
                    <div class="form-group">
                        <label for="tipoprestamo">Tipo de prestamo</label>
                        <select class="form-control" name="tipoprestamo" id="tipoprestamo">
                            <option value="presencial">Presencial</option>
                            <option value="online">En Linea</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="libro">Libro</label>
                        <select class="form-control" name="libro_id" id="libro_id">
                            @foreach ($libros as $libro)
                                <option value="{{$libro->id}}">{{$libro->titulo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('home') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>
</form>

@endsection