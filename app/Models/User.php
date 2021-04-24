<?php

namespace App\Models;

use App\Models\Rol;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Chat_User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id',
        'name',
        'motherlastname',
        'lastname',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol(){
        return $this->belongsTo(Rol::Class);
    }

    public function chats(){
        return $this->belongsToMany(Chat::Class);
    }

    public function messages(){
        return $this->hasMany(Message::Class);
    }

    public function chat_user(){
        return $this->hasOne(Chat_User::Class);
    }

}
