<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoriesController extends Controller
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
        $categories = $user->categories()->orderBy('number', 'asc')->paginate(10);
        // カテゴリー一覧ビューでそれを表示
        return view('categories.index', [
            'categories' => $categories,
        ]);
        
    }
    
    public function create()
    {
        $category = new Category;

        // カテゴリー作成ビューを表示
        return view('categories.create', [
            'category' => $category,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            'number' => 'required',
        ]);
       
        
        // 認証済みユーザ（閲覧者）のカテゴリーとして作成（リクエストされた値をもとに作成）
        $request->user()->categories()->create([
            'name' => $request->name,
            'number' => $request->number,
        ]);

        // カテゴリー一覧へリダイレクトさせる
        return redirect()->route('categories.index');
    }
    
    public function edit($id)
    {
        // idの値でカテゴリーを検索して取得
        $category = Category::findOrFail($id);

        if (\Auth::id() !== $category->user_id) {
            return redirect('/');
        }
        
        return view('categories.edit', ['category' => $category,]);
    }
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:5',
            'number' => 'required',
        ]);
        
        // idの値でカテゴリーを検索して取得
        $category = Category::findOrFail($id);
        
        if (\Auth::id() !== $category->user_id) {
            return redirect('/');
        }
        
        $category->name  = $request->name;
        $category->number = $request->number;
        $category->save();
        
        // カテゴリー一覧へリダイレクトさせる
        return redirect()->route('categories.index');
    }
    
    public function destroy($id)
    {
        // idの値でカテゴリーを検索して取得
        $category = Category::findOrFail($id);
        
        if (\Auth::id() !== $category->user_id) {
            return redirect('/');
        }
        
        $category->delete();
        
        // カテゴリー一覧へリダイレクトさせる
        return redirect()->route('categories.index');
    }

}
