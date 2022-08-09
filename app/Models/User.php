<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        // uno a muchos
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');

    }

    public function copi_followers()
    {
        return $this->belongsToMany(User::class,'copi_followers','user_id','follower_id');
    }

    // comprobar si un usuario sigue a otro
    public function siguiendo(User $user)
    {
        return $this->copi_followers->contains($user->id);

    }

    // almacena los que seguimos
    public function copi_followings()
    {
        return $this->belongsToMany(User::class,'copi_followers','follower_id','user_id');
    }

}
