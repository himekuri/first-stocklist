<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'number',
    ];
    
    /**
     * Userモデルとの関係を定義(このカテゴリーを持つユーザ)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Itemモデルとの関係を定義（このカテゴリーに所属する商品）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
