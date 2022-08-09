<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // cuando es un solo metodo se omite el index y se cambia por invoke
    public function __invoke()
    {
        // latest() ordena los resultados
       $ids= auth()->user()->copi_followings->pluck('id')->toArray();
       $post=Post::whereIn('user_id',$ids)->latest()->paginate(20);

       return view('home',[
           'posts'=>$post
       ]);
    }

}
