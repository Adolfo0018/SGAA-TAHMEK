<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Chat_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //$chats = Chat_User::all()->where('user_id', '!=', '1');
        
        $chats = DB::table('chat_user')
            ->join('users', 'users.id', '=', 'chat_user.user_id')
            ->select('chat_user.user_id', 'users.name')
            ->where('chat_user.user_id', '!=', 1)
            ->get();

        return view('Administrador.Chat.index', ['chats' => $chats]);
    }

    public function show(Chat $chat)
    {
        abort_unless($chat->users->contains(auth()->id()), 403);
        return view('Administrador.Chat.chat', ['chat' => $chat]);
    }

    public function chat_with(User $user)
    {

        $user_a = auth()->user();
        $user_b = $user;

         $chat = $user_a->chats()->wherehas("users", function ($q) use ($user_b) {
             $q->where("chat_user.user_id", $user_b->id);
         })->first();

        if(!$chat){
            $chat = Chat::create([]);
            $chat->users()->sync([$user_a->id, $user_b->id]);
        }

        return redirect()->route('chat.show', $chat);
    }

    public function get_users(Chat $chat)
    {
        $users = $chat->users;

        return response()->json([
            'users' => $users
        ]);
    }

    public function get_messages(Chat $chat){
        $messages = $chat->messages()->with('user')->get();
        return response()->json([
            'messages' => $messages
        ]);
    }
    
}
