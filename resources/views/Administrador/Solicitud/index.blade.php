@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                <a href="{{route('solicitud.create')}}" class="btn btn-success">Agregar</a>
                @if(\Session::get('Mensaje'))
                <br/><br/>
                <div class="alert alert-light-success">
                    <p>{{\Session::get('Mensaje')}}</p>
                </div><br/>
                @endif
            </div>                       
        </div>
    </div>

    @include('Administrador.Partials.session-flash-status')

    <div class="widget-content widget-content-area">
        <table class="table" id="dataTable101" class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Acta</th>
                    <th>Ine</th>
                    <th>Curp</th>
                    <th>Tipo de documento</th>
                    <th>Fecha de solicitud</th>
                    <th>Entregado</th>
                    <th>Descargar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id}}</td>
                    <td>{{ $solicitud->usuario->name}}</td>
                    <td>
                        <img style="width: 150px; height:150px" src="storage/imagenes/solicitudes/acta/{{ $solicitud->acta}}" alt="">
                    </td>
                    <td>
                        <img style="width: 150px; height:150px" src="storage/imagenes/solicitudes/ine/{{ $solicitud->ine}}" alt="">
                    </td>
                    <td>
                        <img style="width: 150px; height:150px" src="storage/imagenes/solicitudes/curp/{{ $solicitud->curp}}" alt="">
                    </td>
                    <td>{{ $solicitud->tipodocumento}}</td>
                    <td>{{ $solicitud->fechasolicitud}}</td>
                    @if ($solicitud->entregado == 1)
                        <td>Si</td>
                    @else
                        <td>No</td>
                    @endif
                    
                    @if ($solicitud->urldocumento)
                        <td>
                            <a href="{{ route('solicitud.descargar', $solicitud->urldocumento)}}" title="Descargar">Descargar</a>
                        </td>    
                    @endif
                
                    <td>
                        {{--  <a title="Editar" href="{{ route('solicitud.edit',$solicitud->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>  --}}
                        <button title="Eliminar" data-toggle="modal" data-target="#deleteSolicitud" id="eliminar" data-id="{{ $solicitud->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png">
                        </button>
                        <a href="{{ route('solicitud.vistaEntregar',$solicitud->id)}}" title="Entregar" class="btn btn-success"><img src="img/General/entrega.png"></a>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@include('Administrador.Partials.modal-delete-solicitud')

@endsection