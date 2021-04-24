@extends('layouts.app')
@section('content')

<div class="statbox widget box box-shadow">

    <div class="widget-content widget-content-area">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.grupoeducar.cl/wp-content//uploads/2019/06/librosdetexto.jpeg" height="200">
                    <div class="card-body">
                      <h5 class="card-title">Libros</h5>
                      <a href="{{route('libro.index')}}" class="btn btn-primary">Acceder</a>
                    </div>
                  </div>
            </div>
        
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="http://www3.gobiernodecanarias.org/medusa/edublog/ceipsantaursula/wp-content/uploads/sites/183/2020/06/imagen-documentos-1.jpg" height="200">
                    <div class="card-body">
                      <h5 class="card-title">Prestamos</h5>
                      <a href="{{route('prestamo.index')}}" class="btn btn-primary">Acceder</a>
                    </div>
                  </div>
            </div>
        
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://cuadernosdeseguridad.com/wp-content/uploads/2018/03/aproser.jpg" height="200">
                    <div class="card-body">
                      <h5 class="card-title">Devoluciones</h5>
                      <a href="{{route('devolucion.index')}}" class="btn btn-primary">Acceder</a>
                    </div>
                  </div>
            </div>
    </div>
</div>

@endsection