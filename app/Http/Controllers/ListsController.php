<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class ListsController extends Controller
{
    public function index()
    {
        // 未ログインの場合はwelcomeページを表示
        if (!\Auth::check()){
            return view('welcome');
        }

        // 認証済みユーザを取得
        $user = \Auth::user();
        // 買い出し先一覧を取得
        $shops = $user->shops()->orderBy('number', 'asc')->get();
        // 商品一覧を取得
        $items = $user->items()->whereIn('status',[1,2])->orderBy('created_at', 'asc')->get();
        
        
        // 買い出し一覧ビューでそれを表示
        return view('lists.index', [
            'items' => $items,
            'shops' => $shops,
        ]);
        
    }
    
    public function update(Request $request)
    {
        $checked_ids = $request->input('cheked_item');
        
        if(!empty($checked_ids)){
            foreach($checked_ids as $id){
                $item = Item::findOrFail($id);
                $item->status = 0;
            }
            $item->save();
        }
        
        return back();
    }
    
    public function filter() 
    {
         // 認証済みユーザを取得
        $user = \Auth::user();
        // 買い出し先一覧を取得
        $shops = $user->shops()->orderBy('number', 'asc')->get();
        // 商品一覧を取得
        $items = $user->items()->whereIn('status',[2])->orderBy('created_at', 'asc')->get();
        
        
        // 買い出し一覧ビューでそれを表示
        return view('lists.filter', [
            'items' => $items,
            'shops' => $shops,
        ]);
    }
}
