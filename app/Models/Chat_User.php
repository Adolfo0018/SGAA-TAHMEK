<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat_User extends Model
{
    use HasFactory;

    protected $table = "chat_user";

    protected $fillable = [
        'id',
        'user_id',
        'chat_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
