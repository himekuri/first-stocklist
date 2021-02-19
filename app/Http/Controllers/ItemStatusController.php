<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class ItemStatusController extends Controller
{
    public function update($id, $status)
    {
        // idの値で商品を検索して取得
        $item = Item::findOrFail($id);
        
        //「買い出し」「要注意」「在庫あり」でstatusを変える
        if($status == 'buy') {
            $item->status = 2;
        } else if($status == 'caution') {
            $item->status = 1;
        } else {
            $item->status = 0;
        }
        $item->save();
        return back();
    }
}
