<?php

namespace App\Models;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\Devolucion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'autor',
        'estatus',
        'disponible',
        'ejemplares',
        'estante',
        'fila',
        'digital'
    ];
    
    public function prestamo(){
        return $this->hasMany(Prestamo::Class);
    }

    public function devolucion(){
        return $this->hasMany(Devolucion::Class);
    }
}
