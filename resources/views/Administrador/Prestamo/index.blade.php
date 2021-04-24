@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-header c-black">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="margin-top: 1%">
                <!-- <h4>Registros</h4> -->
                <a href="{{route('prestamo.create')}}" class="btn btn-success">Agregar</a>

                <form action="{{route('prestamo.generarPdf')}}" method="post">
                @csrf
                <br>
                <label for="fecha">Seleccionar fecha</label>
                <input class="form-control" type="date" id="fecha" name="fecha"> 

                <div class="btn-group" role="group">
                    <input type="radio" name="btnradio" id="btnradio1" value="1" checked>
                    <label for="btnradio1">Dia</label>
                  
                    <input type="radio"  name="btnradio" id="btnradio2" value="2">
                    <label for="btnradio2">Mes</label>
                  
                    <input type="radio"  name="btnradio" id="btnradio3" value="3">
                    <label for="btnradio3">Año</label>
                </div>

                <input class="btn btn-primary form-control" type="submit" value="Generar reporte">
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
                    <th>Fecha de prestamo</th>
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Fecha de devolución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->id }}</td>  
                    <td>{{ $prestamo->creacion}}</td> 
                    <td>{{ $prestamo->libro->titulo }}</td>
                    <td>{{ $prestamo->usuario->name }}</td>
                    <td>{{ $prestamo->devolucion}}</td>
                    <td>
                        <a title="Editar" href="{{ route('prestamo.edit',$prestamo->id)}}" class="btn btn-warning"><img src="img/General/editar.png"></a>
                        <button title="Eliminar" data-toggle="modal" data-target="#deletePrestamo" id="eliminar" data-id="{{ $prestamo->id }}"
                            class="btn btn-danger"><img src="img/General/eliminar.png"></button>
                    </td>
                </tr>
                     
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>



@include('Administrador.Partials.modal-delete-prestamo')

@endsection