<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'logo',
    ];

    public static function setImagen($foto, $actual = false){
        if($foto){
            if($actual){
                Storage::disk('public')->delete("imagenes/empresas/$actual");
            }

            $imageName = Str::random(20). '.jpg';
            $imagen = Image::make($foto)->encode('jpg', 75);
            $imagen->resize(200, 200, function ($constraint){
                $constraint->upsize();
            });
            Storage::disk('public')->put("imagenes/empresas/$imageName", $imagen->stream());
            return $imageName;
        } else{
            return false;
        }
    }
}
