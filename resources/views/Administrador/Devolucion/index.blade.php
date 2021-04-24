@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                
                <form action="{{route('devolucion.generarPdf')}}" method="post">
                @csrf
                <br>
                
                <input class="btn btn-primary form-control" type="submit" value="Generar reporte del dia">
                </form>
                
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
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Fecha de devolución</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devoluciones as $devolucion)
                <tr>
                    <td>{{ $devolucion->id }}</td>
                    <td>{{ $devolucion->libro->titulo }}</td>
                    <td>{{ $devolucion->usuario->name }}</td>
                    <td>{{ $devolucion->devolucion}}</td>

                    @if ($devolucion->estatus == 1)
                        <td>Pendiente</td>
                    @endif
                    @if ($devolucion->estatus == 2)
                        <td>Devuelto</td>
                    @endif
                    
                    <td>
                        <a title="Editar" href="{{ route('devolucion.edit',$devolucion->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>
                        <button title="Eliminar" data-toggle="modal" data-target="#deleteDevolucion" id="eliminar" data-id="{{ $devolucion->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png">
                        </button>
                        <button title="Aprobar" data-toggle="modal" data-target="#aprobarDevolucion" id="eliminar" data-id="{{ $devolucion->id }}"
                            class="btn btn-success"><img src="img/General/cheque.png">
                        </button>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>



@include('Administrador.Partials.modal-delete-devolucion')
@include('Administrador.Partials.modal-aprobar-devolucion')

@endsection