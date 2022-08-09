<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');

    }

    public function store(Request $request)
    {
       // dd($request->remember);

       // dd("Autenticando...");
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        

       // if(auth()->attempt($request->only('email','password')))
         if (!Auth::attempt($request->only('email','password'),$request->remember)){   
            return back()->with('mensaje','Credenciales Incorrectas');
         }
        
         return redirect()->route('posts.index',auth()->user()->username);

    }
}
