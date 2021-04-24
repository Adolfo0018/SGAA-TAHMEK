<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Libro;
use App\Models\Usuario;
use App\Models\Prestamo;
use App\Models\Devolucion;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StorePrestamoPdf;
use App\Http\Requests\StorePrestamoPost;
use App\Http\Requests\StorePrestamoUpdate;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::orderBy('created_at', 'desc')->where('estatus', 1)->paginate(5);

        //return $prestamos;
        return view('Administrador.Prestamo.index', ['prestamos' => $prestamos]);
    }

 
    public function create()
    {
        
        $libros = Libro::all()->where('estatus', 1)->where('disponible', 1);
        $usuarios = Usuario::all()->where('estatus', 1)->where('rol_id', 2);

        return view('Administrador.Prestamo.create', ['prestamos' => new Prestamo(), 'libros' => $libros, 'usuarios' => $usuarios]);
    }

 
    public function store(StorePrestamoPost $request)
    {
        $dia = Str::substr($request->creacion, 8, 2);
        $mes = Str::substr($request->creacion, 5, 2);        
        $anio = Str::substr($request->creacion, 0, 4);

        Prestamo::create($request->validated());
        $p = Prestamo::latest('id')->first();

        $devolucion = new Devolucion();
        $devolucion->devolucion = $request->devolucion;
        $devolucion->libro_id = $request->libro_id;
        $devolucion->usuario_id = $request->usuario_id;
        $devolucion->dia = $dia;
        $devolucion->prestamo_id = $p->id;
        $devolucion->save();
        
        $l = Libro::latest('id')->where('id', $p->libro_id)->first();
        //all()->where('estatus', 1)->where('id', $p->libro_id);
        $ejemplares = $l->ejemplares - 1;

        if($ejemplares <= 0){
            DB::table('libros')->where('id', $p->libro_id)->update(['disponible' => 0]);
        } else{
            DB::table('libros')->where('id', $p->libro_id)->update(['ejemplares' => $ejemplares]);
        }
        
        DB::table('prestamos')->where('id', $p->id)->update(['dia' => $dia, 'mes' => $mes, 'anio' => $anio]);
        
        return back()->with('status', 'Prestamo creado con exito');
    }

 
    public function show(Prestamo $prestamo)
    {
        return view('Administrador.Prestamo.show', ["prestamo" => $prestamo]);
    }

 
    public function edit(Prestamo $prestamo)
    {
        $libros = Libro::all()->where('estatus', 1)->where('disponible', 1);
        $usuarios = Usuario::all()->where('estatus', 1)->where('rol_id', 2);
        return view('Administrador.Prestamo.edit', ['prestamo' => $prestamo, 'libros' => $libros, 'usuarios' => $usuarios]);
    }

    public function update(StorePrestamoUpdate $request, Prestamo $prestamo)
    {
        $prestamo->update($request->validated());
        return back()->with('status', 'Prestamo actualizado con exito');
    }


    public function destroy($id)
    {
        DB::table('prestamos')->where('id', $id)->update(['estatus' => 0]);
        return back()->with('status', 'Prestamo eliminado con exito');
    }

    public function generarPdf(StorePrestamoPdf $request)
    {
        if ($request->validated())
        {
            switch ($request->btnradio) {
                case 1:
                    $fechalike = Str::substr($request->fecha, 8, 2);
                    $prestamos = Prestamo::whereRaw('dia like ?', ["%$fechalike%"])->where('estatus', 1)->get();
                    break;
                case 2:
                    $fechalike = Str::substr($request->fecha, 5, 2);        
                    $prestamos = Prestamo::whereRaw('mes like ?', ["%$fechalike%"])->where('estatus', 1)->get();
                    break;
                case 3:
                    $fechalike = Str::substr($request->fecha, 0, 4);
                    $prestamos = Prestamo::whereRaw('anio like ?', ["%$fechalike%"])->where('estatus', 1)->get();
                    break;
            }

            //$prestamos = Prestamo::orderBy('created_at', 'desc')->paginate(5)->where('creacion', $request->fecha)->where('estatus', 1);
            $view = View::make('Administrador.Prestamo.reporte', compact('prestamos'))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->stream('informe'.'.pdf'); //stream | download
        } else 
        {
            return back()->with('status', 'Es necesario ingresar una fecha');
        }
        //return view('Administrador.Prestamo.reporte', ['prestamos' => $prestamos]);
    }
}
