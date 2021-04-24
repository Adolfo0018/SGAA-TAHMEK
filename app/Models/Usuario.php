<?php

namespace App\Models;

use App\Models\Rol;
use App\Models\Prestamo;
use App\Models\Chat_User;
use App\Models\Solicitud;
use App\Models\Devolucion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;
    protected $table = "users";

    protected $fillable = [
        'rol_id',
        'name',
        'motherlastname',
        'lastname',
        'email',
        'phone',
        'password',
    ];

    public function prestamo(){
        return $this->hasMany(Prestamo::Class);
    }

    public function devolucion(){
        return $this->hasMany(Devolucion::Class);
    }

    public function solicitud(){
        return $this->hasMany(Solicitud::Class);
    }

    public function rol(){
        return $this->belongsTo(Rol::Class);
    }

    public function chats(){
        return $this->hasOne(Chat_User::Class);
    }

}
