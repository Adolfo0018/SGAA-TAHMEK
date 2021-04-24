<?php

namespace App\Models;

use App\Models\Libro;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'usuario_id',
        'libro_id',
        'devolucion',
        'creacion',
        'dia',
        'mes',
        'anio'
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
