<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

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
        $items = \DB::table('items')
        ->rightjoin('categories', 'items.category_id', '=', 'categories.id')
        ->select('items.*')
        ->where('items.user_id', $user)
        ->orderBy('categories.name', 'asc')            
        ->orderBy('items.created_at', 'asc')
        ->paginate(100);
        //created_atとcategoriesテーブルのnumberで複数条件の並び替えがしたい
        
        
        // 商品一覧ビューでそれを表示
        return view('items.index', [
            'items' => $items,
        ]);
        
    }
    
    public function create()
    {
        $item = new Item;
        
        // 認証済みユーザを取得
        $user = \Auth::user();
        // カテゴリー一覧を取得
        $categories = $user->categories()->orderBy('number', 'asc')->paginate(10);
        // 買い出し先一覧を取得
        $shops = $user->shops()->orderBy('number', 'asc')->paginate(10);

        // 商品作成ビューを表示
        return view('items.create', [
            'item' => $item,
            'categories' => $categories,
            'shops' => $shops,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            //写真の登録は任意
            'image_url' => 'nullable',
            'category_id' =>'required',
            'shop_id' =>'required',
        ]);
       
        
        // 認証済みユーザ（閲覧者）の商品として作成（リクエストされた値をもとに作成）
        $request->user()->items()->create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'category_id' => $request->category_id,
            'shop_id' => $request->shop_id,
        ]);

        // 商品一覧へリダイレクトさせる
        return redirect()->route('items.index');
    }
    
    public function edit($id)
    {
        // idの値で商品を検索して取得
        $item = Item::findOrFail($id);

        if (\Auth::id() !== $item->user_id) {
            return redirect('/');
        }
        
        return view('items.edit', ['item' => $item,]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            //写真の登録は任意
            'image_url' => 'nullable',
            'category_id' =>'required',
            'shop_id' =>'required',
        ]);
        
        // idの値で商品を検索して取得
        $item = Item::findOrFail($id);
        
        if (\Auth::id() !== $item->user_id) {
            return redirect('/');
        }
        
        $item->name  = $request->name;
        $item->image_url = $request->image_url;
        $item->category_id = $request->category_id;
        $item->shop_id = $request->shop_id;
        $item->save();
        
        // 商品一覧へリダイレクトさせる
        return redirect()->route('items.index');
    }
    
    public function destroy($id)
    {
        // idの値で商品を検索して取得
        $item = Item::findOrFail($id);
        
        if (\Auth::id() !== $item->user_id) {
            return redirect('/');
        }
        
        $item->delete();
        
        // 商品一覧へリダイレクトさせる
        return redirect()->route('items.index');
    }
}
