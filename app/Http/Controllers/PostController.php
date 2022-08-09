<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{
    //
    public function __construct()
    {   // solo usuarios autenticados
        $this->middleware('auth')->except(['show','index']);
        
    }
    public function index(User $user)
    {
       // $posts=Post::where('user_id',$user->id)->get();
        $posts=Post::where('user_id',$user->id)->latest()->paginate(5);
       
        return view('dashboard',[
            "user"=>$user,
            "posts"=>$posts
        ]);

    }
    public function create()
    {
        return view('posts.create');

    }
    public function store(Request $request)
    {
       $this->validate($request,[
        'titulo'=>"required|max:255",
        'descripcion'=>'required',
        'imagen'=>'required',
       ]);

       Post::create([
           "titulo"=>$request->titulo,
           "descripcion"=>$request->descripcion,
           "imagen"=>$request->imagen,
           "user_id"=>auth()->user()->id,
       ]);

       // otra forma de guardar
/*        $post = new Post;
       $post->titulo=$request->titulo;
       $post->descripcion=$request->descripcion;
       $post->save(); */

       // otra forma de guardar ya con las relaciones establecidas
/*
       $request->user()->posts()->create([
            "titulo"=>$request->titulo,
            "descripcion"=>$request->descripcion,
            "imagen"=>$request->imagen,
            "user_id"=>auth()->user()->id,
       ]);
*/
       return redirect()->route('posts.index',auth()->user()->username);

    }

    public function show(User $user,Post $post)
    {
        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);

    }

    public function destroy(Post $post)
    {
/*         if($post->user_id===auth()->user()->id){
            dd("Si es la misma",$post->id);
        } else{
            dd("no es la misma");
        } */

        $this->authorize("delete",$post);
        $post->delete();

        // eliminar la imagen
        $imagen_path = public_path("uploads/" . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);

        }
        return redirect()->route("posts.index",auth()->user()->username);
        
    }
}
