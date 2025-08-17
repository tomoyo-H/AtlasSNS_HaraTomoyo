<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     // 自分がフォローしている人（フォロー数を数える用）
     public function followings()
     {
         return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
     }

     // 自分をフォローしている人（フォロワー数を数える用）
     public function followers()
     {
         return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
     }
}
