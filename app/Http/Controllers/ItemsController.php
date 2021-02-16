<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use JD\Cloudder\Facades\Cloudder;

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
        // カテゴリー一覧を取得
        $categories = $user->categories()->orderBy('number', 'asc')->get();
        // 商品一覧を取得
        $items = $user->items()->orderBy('created_at', 'asc')->get();
        
        
        
        // 商品一覧ビューでそれを表示
        return view('items.index', [
            'items' => $items,
            'categories' => $categories,
        ]);
        
    }
    
    public function create()
    {
        $item = new Item;
        
        // 認証済みユーザを取得
        $user = \Auth::user();
        // カテゴリー一覧を取得
        $categories = $user->categories()->orderBy('number', 'asc')->get();
        // 買い出し先一覧を取得
        $shops = $user->shops()->orderBy('number', 'asc')->get();

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
            'image_id' => 'nullable',
            'category_id' =>'required',
            'shop_id' =>'required',
        ]);
       
       
        if ($image = $request->file('image_url')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $request->image_url = Cloudder::secureShow($publicId, [
                'width'     => 70,
                'height'    => 70
            ]);
            $request->image_id = $publicId;
        }
        
        // 認証済みユーザ（閲覧者）の商品として作成（リクエストされた値をもとに作成）
        $request->user()->items()->create([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'image_id' => $request->image_id,
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
        
        // 認証済みユーザを取得
        $user = \Auth::user();
        // カテゴリー一覧を取得
        $categories = $user->categories()->orderBy('number', 'asc')->get();
        // 買い出し先一覧を取得
        $shops = $user->shops()->orderBy('number', 'asc')->get();
        
        return view('items.edit', [
            'item' => $item,
            'categories' => $categories,
            'shops' => $shops,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            //写真の登録は任意
            'image_url' => 'nullable',
            'image_id' => 'nullable',
            'category_id' =>'required',
            'shop_id' =>'required',
        ]);
        
        // idの値で商品を検索して取得
        $item = Item::findOrFail($id);
        
        if (\Auth::id() !== $item->user_id) {
            return redirect('/');
        }
        
        if ($image = $request->file('image_url')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $request->image_url = Cloudder::secureShow($publicId, [
                'width'     => 70,
                'height'    => 70
            ]);
            $request->image_id = $publicId;
        }
        
        $item->name  = $request->name;
        $item->image_url = $request->image_url;
        $item->image_id = $request->image_id;
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
        
        if(isset($item->image_id)){
            Cloudder::destroyImage($item->image_id);
        }
        
        $item->delete();
        
        // 商品一覧へリダイレクトさせる
        return redirect()->route('items.index');
    }
}
