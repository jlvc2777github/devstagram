<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use League\CommonMark\Node\Block\Document;

class ImagenController extends Controller
{
    //
    public function store3(Request $request)
    {
      $imagen=$request->file('file');
      $nombreImagen=Str::uuid() . "." . $imagen->extension();

      return response()->json(['imagen'=>$nombreImagen]);
    }



    public function store(Request $request)
    {
        $request->validate([
            "file"=>"required|image|max:2048"
        ]);

        $input=$request->all();
        
        $imagen=$request->file('file');

        $nombreImagen=Str::uuid() . "." . $imagen->extension();
        

       // $imagenPath = public_path('uploads') . "/" . $nombreImagen;
        $imagenPath =  "/uploads/" . $nombreImagen;
        //dd($imagenPath);

      //  $imagenServidor = $request->file('file')->store($nombreImagen);
        $imagenServidor = $request->file('file')->store($imagenPath);

     // return response()->json(['imagen'=>$nombreImagen]);
      return redirect()->route('posts.create',$nombreImagen);
      
    }
    public function store2(Request $request)
    {
        $request->validate([
            "file"=>"required|image|max:2048"
        ]);

        $input=$request->all();
        
        $imagen=$request->file('file');

        $nombreImagen=Str::uuid() . "." . $imagen->extension();
        
        // dropzone
        $imagenServidor=Image::make($imagen);
        $imagenServidor->fit(1000,1000);

        $imagenPath = public_path('uploads') . "/" . $nombreImagen;
       // $imagenPath =  "/uploads/" . $nombreImagen;
        $imagenServidor->save($imagenPath);

      //  $imagenServidor = $request->file('file')->store($nombreImagen);
        $imagenServidor = $request->file('file')->store($imagenPath);

      return response()->json(['imagen'=>$nombreImagen]);
    //  return redirect()->route('posts.create',$nombreImagen);
      
    }
}