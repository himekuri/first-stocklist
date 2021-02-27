@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb" class="col-9 d-inline-block">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">カテゴリー一覧</li>
        </ol>
    </nav>
    <div class="mb-3 text-right d-inline-block">
        <a href="/categories/create" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    {{-- カテゴリー一覧を表示する --}}
     @if (count($categories)>0)
        <table class="table">
            <tbody>
                @foreach ($categories as $category)
                    <tr>                        
                        {{-- カテゴリー名を押すと編集ページへ飛ぶ --}}
                        <td class="align-middle">{!! link_to_route('categories.edit', $category->name, ['category' => $category->id]) !!}</td>
                        {{-- 買い出し先一覧と見た目を合わせる --}}
                        <td>　　　　</td>
                        <td>
                            {!! Form::model($category, ['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash-alt"></i>', ['class' => "btn", 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>        
        </table>
    @else
        <div class="center jumbotron">
            <div class="text-center">                
                <h3>さっそくカテゴリーを登録してみましょう！</h3>
                <p>(例) 野菜、ドリンク、備品</p>
                {{-- カテゴリー登録ページへのリンク --}}                    
                {!! link_to_route('categories.create', 'カテゴリーを新規作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection