<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name', 'number', 'gmap_url',
    ];
    
    /**
     * Userモデルとの関係を定義(この買い出し先を持つユーザ)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Itemモデルとの関係を定義（この買い出し先に所属する商品）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
