<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Categoryモデル,Shopモデル,Itemモデルとの関係を定義（このユーザが持つカテゴリー、買い出し先、商品）
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
