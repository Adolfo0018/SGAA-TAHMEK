<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreLibroPost;
use App\Http\Requests\StoreLibroUpdate;
use App\Http\Requests\StoreLibroPdfPost;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::orderBy('created_at', 'desc')->where('estatus', 1)->paginate(5);

        //return $libros;
        return view('Administrador.Libro.index', ['libros' => $libros]);
    }

 
    public function create()
    {
        return view('Administrador.Libro.create', ['libros' => new Libro()]);
    }

 
    public function store(StoreLibroPost $request)
    {
        Libro::create($request->validated());
        return back()->with('status', 'Libro creado con exito');
    }

 
    public function show(Libro $libro)
    {
        return view('Administrador.Libro.show', ["libro" => $libro]);
    }

 
    public function edit(Libro $libro)
    {
        return view('Administrador.Libro.edit', ['libro' => $libro]);
    }

    public function update(StoreLibroUpdate $request, Libro $libro)
    {
        $libro->update($request->validated());
        return back()->with('status', 'Libro actualizado con exito');
    }


    public function destroy($id)
    {
        DB::table('libros')->where('id', $id)->update(['estatus' => 0]);
        return back()->with('status', 'Libro eliminado con exito');
    }

    public function vistaCargar($id){
        return view('Administrador.Libro.entregar', ['id' => $id]);
    }

    public function cargar(StoreLibroPdfPost $request){
        $nombre = $request->file('digital')->store('public/imagenes/libros/digital');

        $numero = strlen($nombre);

        $digital = Str::substr($nombre, 31);
        
        DB::table('libros')->where('id', $request->id)->update(['digital' => $digital]);
        return back()->with('status', 'Libro digital cargado con exito');
    }

    public function descargar($file)
    {
        $pathtoFile = public_path().'/imagenes/libros/digital/'.$file;
        return response()->download($pathtoFile);
    }
}
