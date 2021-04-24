@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                <a href="{{route('libro.create')}}" class="btn btn-success">Agregar</a>
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
                    <th>Descripción</th>
                    <th>Autor</th>
                    <th>Disponible</th>
                    <th>Ejemplares</th>
                    <th>Estante</th>
                    <th>Fila</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>{{ $libro->titulo}}</td>
                    <td>{{ $libro->descripcion}}</td>
                    <td>{{ $libro->autor}}</td>
                    @if ($libro->disponible == 1)
                        <td>Si</td>
                    @else
                        <td>No</td>
                    @endif
                    <td>{{ $libro->ejemplares}}</td>
                    <td>{{ $libro->estante}}</td>
                    <td>{{ $libro->fila}}</td>
                    <td>
                        <a href="{{ route('libro.edit',$libro->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>
                        <button data-toggle="modal" data-target="#deleteLibro" id="eliminar" data-id="{{ $libro->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png">
                        </button>
                        <a href="{{ route('libro.vistaCargar',$libro->id)}}" title="Cargar" class="btn btn-success"><img src="img/General/entrega.png"></a>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@include('Administrador.Partials.modal-delete-libro')

@endsection