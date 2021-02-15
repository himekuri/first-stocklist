<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'image_url','image_id', 'category_id', 'shop_id',
    ];
    
    /**
     * Userモデル,Categoryモデル,Shopモデルとの関係を定義(この商品のユーザ、カテゴリー、買い出し先)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
