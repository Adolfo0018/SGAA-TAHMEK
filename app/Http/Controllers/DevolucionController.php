<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Libro;
use App\Models\Usuario;
use App\Models\Prestamo;
use App\Models\Devolucion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreDevolucionUpdate;

class DevolucionController extends Controller
{
    public function index()
    {

        $devoluciones = Devolucion::orderBy('created_at', 'desc')->where('estatus', 1)->orWhere('estatus', 2)->paginate(5);

        //return $devoluciones;
        return view('Administrador.Devolucion.index', ['devoluciones' => $devoluciones]);
    }

 
    public function create()
    {
        
        $libros = Libro::all()->where('estatus', 1)->where('disponible', 1);
        $usuarios = Usuario::all()->where('estatus', 1)->where('rol_id', 2);

        return view('Administrador.Devolucion.create', ['devoluciones' => new Devolucion(), 'libros' => $libros, 'usuarios' => $usuarios]);
    }

 
    public function store(StoreDevolucionPost $request)
    {
        
    }

 
    public function show(Devolucion $devolucion)
    {
        return view('Administrador.Devolucion.show', ["devolucion" => $devolucion]);
    }

 
    public function edit(Devolucion $devolucion)
    {
        $libros = Libro::all()->where('estatus', 1)->where('disponible', 1);
        $usuarios = Usuario::all()->where('estatus', 1)->where('rol_id', 2);
        return view('Administrador.Devolucion.edit', ['devolucion' => $devolucion, 'libros' => $libros, 'usuarios' => $usuarios]);
    }

    public function update(StoreDevolucionUpdate $request)
    {
        $devolucion->update($request->validated());
        return back()->with('status', 'Devolucion actualizado con exito');
    }


    public function destroy($id)
    {
        DB::table('devoluciones')->where('id', $id)->update(['estatus' => 0]);
        return back()->with('status', 'Devolucion eliminado con exito');
    }

    public function aprobar($id)
    {

        $prestamo = Devolucion::latest('prestamo_id')->where('estatus', 1)->where('id', $id)->first();
        //$prestamo = Prestamo::all()->where('estatus', 1)->where('id', $id);
        $prestamo->libro_id;

        $libro = Libro::latest('id')->where('estatus', 1)->where('id', $prestamo->libro_id)->first();
        //$libro = Libro::all()->where('estatus', 1)->where('id', $prestamo->libro_id);
        $ejemplares = $libro->ejemplares;
        $nuevacantidadejemplares = $ejemplares + 1;

        if($nuevacantidadejemplares >= 1){
            DB::table('libros')->where('id', $prestamo->libro_id)->update(['disponible' => 1]);
        } else{
            
        }

        DB::table('libros')->where('id', $prestamo->libro_id)->update(['ejemplares' => $nuevacantidadejemplares]);
        DB::table('devoluciones')->where('id', $id)->update(['estatus' => 2, 'devolucionreal' => Carbon::Now()]);

        return back()->with('status', 'Devolucion aprobada con exito');
    }

    public function generarPdf()
    {
        $devoluciones = Devolucion::all()->where('estatus', 2)->where('devolucionreal', Str::substr(Carbon::now(), 0, 10));
        $view = View::make('Administrador.Devolucion.reporte', compact('devoluciones'))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf'); //stream | download
    }
}
