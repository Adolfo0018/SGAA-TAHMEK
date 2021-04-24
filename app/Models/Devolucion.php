<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = "devoluciones";

    protected $fillable = [
        'id',
        'usuario_id',
        'libro_id',
        'devolucion',
        'devolucionreal',
        'dia'
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
