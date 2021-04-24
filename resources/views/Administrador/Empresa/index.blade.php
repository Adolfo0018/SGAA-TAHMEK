@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                <a href="{{route('empresa.create')}}" class="btn btn-success">Agregar</a>
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
                    <th>Empresa</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->nombre}}</td>
                    <td>
                        <img class="rounded" src="storage/imagenes/empresas/{{$empresa->logo}}">
                    </td>   
                    
                    <td>
                        <a href="{{ route('empresa.edit',$empresa->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>
                        <button data-toggle="modal" data-target="#deleteModal" id="eliminar" data-id="{{ $empresa->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png"></button>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('Administrador.Partials.modal-delete')

@endsection