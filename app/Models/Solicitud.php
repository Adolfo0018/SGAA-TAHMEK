<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = "solicitudes";

    protected $fillable = [
        'id',
        'usuario_id',
        'acta',
        'ine',
        'curp',
        'tipodocumento',
        'fechasolicitud',
        'fechaentrega',
        'urldocumento',
        'estatus',
        'entregado'
    ];

    public static function setImagen($foto, $acta , $curp, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/solicitudes/ine/$actual");
            }

            $imageName = Str::random(20). '.jpg';

            $imagen = Image::make($foto)->encode('jpg', 75);

            $imagen->resize(400, 400, function ($constraint){
                $constraint->upsize();
            });

            Storage::disk('public')->put("imagenes/solicitudes/ine/$imageName", $imagen->stream());
            
            if($acta){
                $actaimageName = Str::random(20). '.jpg';
                $acta = Image::make($acta)->encode('jpg', 75);
                $acta->resize(400, 400, function ($constraint){
                    $constraint->upsize();
                });
                Storage::disk('public')->put("imagenes/solicitudes/acta/$actaimageName", $acta->stream());
            }

            if($curp){
                $curpimageName = Str::random(20). '.jpg';
                $curp = Image::make($curp)->encode('jpg', 75);
                $curp->resize(400, 400, function ($constraint){
                    $constraint->upsize();
                });
                Storage::disk('public')->put("imagenes/solicitudes/curp/$curpimageName", $curp->stream());
            }

            $dataimage = [
                "ine" => $imageName,
                "acta" => $actaimageName,
                "curp" => $curpimageName
            ];

            return $dataimage;
            }
         else{
            return false;
        }
    }

    public static function setPdf($pdf){

            $pdfName = Str::random(20). '.pdf';

            Storage::disk('public')->put("imagenes/solicitudes/ine/$pdfName", $pdf->stream());
            
            
            return $pdfName;
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
