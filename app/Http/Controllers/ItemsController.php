<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        // 未ログインの場合はwelcomeページを表示
        if (!\Auth::check()){
            return view('welcome');
        }

        // 認証済みユーザを取得
        $user = \Auth::user();
        // 商品一覧を取得
        $items = $user->items()->orderBy('created_at', 'desc');
        
        // 商品一覧ビューでそれを表示
        return view('items.index', [
            'items' => $items,
        ]);
        
    }
}
