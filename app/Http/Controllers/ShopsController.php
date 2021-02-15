<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shop;

class ShopsController extends Controller
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
        $shops = $user->shops()->orderBy('number', 'asc')->paginate(10);
        // 買い出し先一覧ビューでそれを表示
        return view('shops.index', [
            'shops' => $shops,
        ]);
        
    }
    
    public function create()
    {
        $shop = new Shop;

        // 買い出し先作成ビューを表示
        return view('shops.create', [
            'shop' => $shop,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            'number' => 'required',
            'gmap_url' => 'nullable',
        ]);
       
        
        // 認証済みユーザ（閲覧者）の買い出し先として作成（リクエストされた値をもとに作成）
        $request->user()->shops()->create([
            'name' => $request->name,
            'number' => $request->number,
            'gmap_url' => $request->gmap_url,
            
        ]);

        // 買い出し先一覧へリダイレクトさせる
        return redirect()->route('shops.index');
    }
    
    
    
    public function edit($id)
    {
        // idの値で買い出し先を検索して取得
        $shop = Shop::findOrFail($id);

        if (\Auth::id() !== $shop->user_id) {
            return redirect('/');
        }
        
        return view('shops.edit', ['shop' => $shop,]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            'number' => 'required',
            'gmap_url' => 'nullable',
        ]);
        
        // idの値で買い出し先を検索して取得
        $shop = Shop::findOrFail($id);
        
        if (\Auth::id() !== $shop->user_id) {
            return redirect('/');
        }
        
        $shop->name  = $request->name;
        $shop->number = $request->number;
        $shop->gmap_url = $request->gmap_url;
        $shop->save();
        
        // 買い出し先一覧へリダイレクトさせる
        return redirect()->route('shops.index');
    }
    
    public function destroy($id)
    {
        // idの値で買い出し先を検索して取得
        $shop = Shop::findOrFail($id);
        
        if (\Auth::id() !== $shop->user_id) {
            return redirect('/');
        }
        
        $shop->delete();
        
        // カテゴリー一覧へリダイレクトさせる
        return redirect()->route('shops.index');
    }
    
    public function gmap($id)
    {
         // idの値でタスクを検索して取得
        $shop = Shop::findOrFail($id);
        
        $url = $shop->gmap_url;
        
        //GoogleMapのURLへリダイレクト
        return redirect()->away($url);
    }
}
