<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    //
    public function store(User $user,Request $request)
    {
     //   dd("Follow");
     //   $user->followers()->attach(auth()->user()->id);

     // copia de follower los constrains no me dejan avanzar
     $user->copi_followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user)
    {
      //  dd($user);
        $user->copi_followers()->detach(auth()->user()->id);

        return back();
    }
}
