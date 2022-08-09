<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
       // dd($request);
       // modificar el request
       $request->request->add([Str::slug($request->username)]);

       // validacion
       $this->validate($request,[
        'name'=>'required|max:30',
        'username'=>'required|unique:users|min:3|max:30',
        'email'=>'required|unique:users|email|max:60',
        'password'=>'required|confirmed|min:6'

       ]);

       //dd("creando usuario..");

       User::create([
        'name'=>$request->name,
        'username'=>$request->username, //slug elimina los espacios y acentos
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
       ]);

       // autentica usuario
       Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password,
       ]);
       
       // redireccionar
       return redirect()->route('posts.index');


    }
}
