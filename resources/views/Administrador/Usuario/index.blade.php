@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                <a href="{{route('usuario.create')}}" class="btn btn-success">Agregar</a>
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
                    <th>Nombre</th>
                    <th>Apellido materno</th>
                    <th>Apellido paterno</th>
                    <th>Correo electronico</th>
                    <th>Telefono</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name}}</td>
                    <td>{{ $usuario->motherlastname}}</td>
                    <td>{{ $usuario->lastname}}</td>
                    <td>{{ $usuario->email}}</td>
                    <td>{{ $usuario->phone}}</td>
                    <td>
                        <a title="restablecer contraseña" href="{{ route('usuario.vistaRestablecer',$usuario->id)}}" class="btn btn-info"><img src="img/General/sincronizar.png"></a>
                        <a title="editar" href="{{ route('usuario.edit',$usuario->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>
                        <button title="eliminar" data-toggle="modal" data-target="#deleteUsuario" id="eliminar" data-id="{{ $usuario->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png"></button>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('Administrador.Partials.modal-delete-usuario')

@endsection