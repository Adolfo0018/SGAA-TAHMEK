@extends('layouts.appuser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>BIENVENIDO {{ Auth::user()->name }} ¿EN QUE PODEMOS AYUDARLO?</p>    

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="https://www.grupoeducar.cl/wp-content//uploads/2019/06/librosdetexto.jpeg" height="200">
                                <div class="card-body">
                                  <h5 class="card-title">PRESTAMO DE LIBROS</h5>
                                  <a href="{{ route("solicitud.crear") }}" class="btn btn-primary">Solicitar</a>
                                </div>
                              </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="http://www3.gobiernodecanarias.org/medusa/edublog/ceipsantaursula/wp-content/uploads/sites/183/2020/06/imagen-documentos-1.jpg" height="200">
                                <div class="card-body">
                                  <h5 class="card-title">SOLICITUD DE DOCUMENTO</h5>
                                  <a href="{{ route("solicitudusuario.index") }}" class="btn btn-primary">Solicitar</a>
                                </div>
                              </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="https://cuadernosdeseguridad.com/wp-content/uploads/2018/03/aproser.jpg" height="200">
                                <div class="card-body">
                                  <h5 class="card-title">SERVICIOS DE SEGURIDAD</h5>
                                  <a href="{{ route('chat.with', 1) }}" class="btn btn-primary">Solicitar</a>
                                </div>
                              </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection