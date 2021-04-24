@extends('layouts.app')

@section('content')

@include('Administrador.Partials.validation-error')

@include('Administrador.Partials.session-flash-status')

<form action="{{ route("solicitud.entregar") }}" method="POST" enctype="multipart/form-data">
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
                
                    <input type="hidden" name="id" value="{{ $id }}">

                    <input type="hidden" name="usuario_id" value="{{Auth::user()->id}}">

                    <div class="form-group">
                        <label for="urldocumento">Documento</label>
                        <input class="form-control" type="file" name="urldocumento" id="urldocumento">
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-success"> 
                    <a class="btn btn-default" href="{{ route('solicitud.index') }}">Cancelar</a>
                </div>
            </div>
        </div>
    
    </div>
</form>

@endsection