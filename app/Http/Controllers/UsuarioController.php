<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsuarioPost;
use App\Http\Requests\StoreUsuarioUpdate;
use App\Http\Requests\StoreUsuarioPasswordUpadte;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->paginate(5)->where('estatus', 1);

        //return $usuarios;
        return view('Administrador.Usuario.index', ['usuarios' => $usuarios]);
    }

 
    public function create()
    {
        return view('Administrador.Usuario.create', ['usuarios' => new Usuario()]);
    }

 
    public function store(StoreUsuarioPost $request)
    {
        Usuario::create($request->validated());
        return back()->with('status', 'Usuario creado con exito');
    }

 
    public function show(Usuario $usuario)
    {
        return view('Administrador.Usuario.show', ["usuario" => $usuario]);
    }

 
    public function edit(Usuario $usuario)
    {
        return view('Administrador.Usuario.edit', ['usuario' => $usuario]);
    }

    public function update(StoreUsuarioUpdate $request, Usuario $usuario)
    {
        $usuario->update($request->validated());
        return back()->with('status', 'Usuario actualizado con exito');
    }


    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->update(['estatus' => 0]);
        return back()->with('status', 'Usuario eliminado con exito');
    }

    public function vistaRestablecer($id)
    {
        $usuarios = Usuario::findOrFail($id);
        return view('Administrador.Usuario.vistarestablecer', ['usuarios' => $usuarios]);
    }


    public function restablecer($id, StoreUsuarioPasswordUpadte $request)
    {
        DB::table('users')->where('id', $id)->update(['password' => Hash::make($request->password)]);
        return back()->with('status', 'Contraseña restablecida con exito');
    }
}
