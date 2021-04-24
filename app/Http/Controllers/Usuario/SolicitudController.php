<?php

namespace App\Http\Controllers\Usuario;

use Carbon\Carbon;
use App\Models\Libro;
use App\Models\Usuario;
use App\Models\Prestamo;
use App\Models\Devolucion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUsuarioSolicitarPost;

class SolicitudController extends Controller
{
    public function crear()
    {
        $libros = Libro::all()->where('estatus', 1)->where('disponible', 1);
        return view('Usuario.create', ['usuarios' => new Usuario(), 'libros' => $libros]);
    }

 
    public function solicitar(StoreUsuarioSolicitarPost $request)
    {

        $fecha = Carbon::now();

        $request->validated();
        $prestamo = new Prestamo();
        $prestamo->usuario_id = $request->usuario_id;
        $prestamo->libro_id = $request->libro_id;
        $prestamo->devolucion = $fecha->addDay(10);
        $prestamo->tipoprestamo = $request->tipoprestamo;
        $prestamo->creacion = Carbon::now();
        $prestamo->save();

        $p = Prestamo::latest('id')->first();

        if($request->tipoprestamo == "online"){

            $l = Libro::latest('id')->where('id', $request->libro_id)->first();
            $hoy = Carbon::Now();
            $dia = Str::substr($hoy, 8, 2);
            $mes = Str::substr($hoy, 5, 2);        
            $anio = Str::substr($hoy, 0, 4);
            DB::table('prestamos')->where('id', $p->id)->update(['dia' => $dia, 'mes' => $mes, 'anio' => $anio]);
            return Storage::download("public/imagenes/libros/digital/$l->digital");
            
        } else{
            
            $hoy = Carbon::Now();
            $dia = Str::substr($hoy, 8, 2);
            $mes = Str::substr($hoy, 5, 2);        
            $anio = Str::substr($hoy, 0, 4);

            $devolucion = new Devolucion();
            $devolucion->devolucion = $hoy->addDay(10);
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

            $usuarios = Usuario::all()->where('estatus', 1)->where('id', $request->usuario_id);
            $prestamos = Prestamo::all()->where('estatus', 1)->where('usuario_id', $request->usuario_id)->where('creacion', Str::substr(Carbon::now(), 0, 10));
            $view = View::make('Usuario.reporte', compact('prestamos', 'usuarios'))->render();
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
            return $pdf->download('informe'.'.pdf'); //stream | download

            return back()->with('status', 'Solicitud de prestamo exitoso');
        }

        
    }

    
}
