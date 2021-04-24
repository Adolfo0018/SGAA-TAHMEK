<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Usuario/home', [App\Http\Controllers\Usuario\UsuarioController::class, 'index']);

Route::post('/Solicitud/solicitar', [App\Http\Controllers\Usuario\SolicitudController::class, 'solicitar'])->name('solicitud.solicitar');;

Route::get('/Solicitud/crear', [App\Http\Controllers\Usuario\SolicitudController::class, 'crear'])->name('solicitud.crear');;

Route::get('/Biblioteca', [App\Http\Controllers\BibliotecaController::class, 'index'])->name('biblioteca');

Route::resource('empresa', 'App\Http\Controllers\EmpresaController');

Route::resource('libro', 'App\Http\Controllers\LibroController');

Route::resource('usuario', 'App\Http\Controllers\UsuarioController');

Route::get('/usuario/vistarestablecer/{id}', [App\Http\Controllers\UsuarioController::class, 'vistaRestablecer'])->name('usuario.vistaRestablecer');

Route::Put('/usuario/restablecer/{id}', [App\Http\Controllers\UsuarioController::class, 'restablecer'])->name('usuario.restablecer');

Route::resource('prestamo', 'App\Http\Controllers\PrestamoController');

Route::Post('pdf', [App\Http\Controllers\PrestamoController::class, 'generarPdf'])->name('prestamo.generarPdf');

Route::resource('devolucion', 'App\Http\Controllers\DevolucionController');

Route::Post('devolucion/pdf', [App\Http\Controllers\DevolucionController::class, 'generarPdf'])->name('devolucion.generarPdf');

Route::Post('/aprobar/{id}', [App\Http\Controllers\DevolucionController::class, 'aprobar'])->name('devolucion.aprobar');

Route::resource('solicitud', 'App\Http\Controllers\SolicitudController');

Route::get('vistaEntregar/{id}', [App\Http\Controllers\SolicitudController::class, 'vistaEntregar'])->name('solicitud.vistaEntregar');

Route::Post('entregar', [App\Http\Controllers\SolicitudController::class, 'entregar'])->name('solicitud.entregar');

Route::get('/descargar/{file}', function ($file) {
    return Storage::download("public/imagenes/solicitudes/pdf/$file");
})->name('solicitud.descargar');

Route::get('vistaCargar/{id}', [App\Http\Controllers\LibroController::class, 'vistaCargar'])->name('libro.vistaCargar');

Route::Post('cargar', [App\Http\Controllers\LibroController::class, 'cargar'])->name('libro.cargar');

Route::get('libro/descargar/{file}', function ($file) {
    return Storage::download("public/imagenes/libros/digital/$file");
})->name('libro.descargar');

Route::resource('solicitudusuario', 'App\Http\Controllers\Usuario\DocumentoController');

Route::get('usuario/descargar/{file}', function ($file) {
    return Storage::download("public/imagenes/solicitudes/pdf/$file");
})->name('solicitudusuario.descargar');

Route::get('chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');

Route::get('chat/with/{user}', [App\Http\Controllers\ChatController::class, 'chat_with'])->name('chat.with');

Route::get('chat/{chat}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');

Route::Post('message/sent', [App\Http\Controllers\MessageController::class, 'sent'])->name('message.sent');

Route::get('chat/{chat}/get_users', [App\Http\Controllers\ChatController::class, 'get_users'])->name('chat.get_users');

Route::get('chat/{chat}/get_messages', [App\Http\Controllers\ChatController::class, 'get_messages'])->name('chat.get_messages');

Route::get('auth/user', function (){
    if(auth()->check()){
        return response()->json([
            'authUser' => auth()->user()
        ]);
    }

    return null;
});
