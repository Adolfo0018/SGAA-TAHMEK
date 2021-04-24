<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Solicitud;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSolicitudPost;
use App\Http\Requests\StoreSolicitudPdfPost;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::orderBy('created_at', 'desc')->where('estatus', 1)->paginate(5);

        //return $solicitudes;
        return view('Administrador.Solicitud.index', ['solicitudes' => $solicitudes]);
    }

    public function create()
    {
        return view('Administrador.Solicitud.create', ['solicitudes' => new Solicitud()]);
    }

 
    public function store(StoreSolicitudPost $request)
    {

        if($dataimage = Solicitud::setImagen($request->ine, $request->acta, $request->curp)){   
            //$request->request->add(['logo' => $foto]);

            $imagenes = array_values($dataimage);
            
            $data = [
                'usuario_id' => $request->usuario_id,
                'tipodocumento' => $request->tipodocumento,
                'fechasolicitud' => Carbon::now(),
                'ine' => $imagenes[0],
                'acta' => $imagenes[1],
                'curp' => $imagenes[2]

            ];
            
            Solicitud::create($data);

            return back()->with('status', 'Solicitud creada con exito');
        }

        Solicitud::create($request->validated());
        return back()->with('status', 'Solicitud creado con exito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        
    }

    
    public function destroy($id)
    {
        DB::table('solicitudes')->where('id', $id)->update(['estatus' => 0]);
        return back()->with('status', 'Solicitud eliminada con exito');
    }

    public function vistaEntregar($id){
        return view('Administrador.Solicitud.entregar', ['id' => $id]);
    }

    public function entregar(StoreSolicitudPdfPost $request){
        $nombre = $request->file('urldocumento')->store('public/imagenes/solicitudes/pdf');

        $numero = strlen($nombre);

        $urldocumento = Str::substr($nombre, 32);
        
        DB::table('solicitudes')->where('id', $request->id)->update(['urldocumento' => $urldocumento, 'entregado' => 1]);
        return back()->with('status', 'Documento entregado con exito');
    }

    public function descargar($file)
    {

        $pathtoFile = public_path().'/imagenes/solicitudes/pdf/'.$file;
        return response()->download($pathtoFile);
    }
}
