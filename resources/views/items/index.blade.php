@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb" class="col-9 d-inline-block">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">商品一覧</li>
        </ol>
    </nav>
    <div class="mb-3 text-right d-inline-block">
        <a href="/lists/only_buy" class="btn btn-primary"><i class="far fa-list-alt"></i></a>
        <a href="/items/create" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    
    
    @if (count($items)>0)
        {{-- 検索ボックスを表示する --}}
        {!! Form::open(['method'=>'get','route'=>['items.serch']]) !!}
            <div class="input-group mb-3 col-md-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'商品を検索']) !!}
                <div class="input-group-append">
                    {!! Form::submit('検索',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
        {{-- 商品一覧を表示する --}}
        @foreach ($categories as $category)
            <div class="bg-secondary text-white pl-2">{{$category->name}}</div>
                <table class="table">
                    <tbody>
                        @foreach($category->items as $item)
                            <tr> 
                                <td><img src="{{ $item->image_url }}" alt="画像"></td>
                                {{-- 買い出し先名を押すと編集ページへ飛ぶ --}}
                                <td class="align-middle text-left">
                                    {!! link_to_route('items.edit', $item->name, ['item' => $item->id]) !!}
                                </td>
                                <td class="w-25 align-middle">
                                    @if($item->status == 2)
                                        <button type="button" class="btn btn-danger btn-sm mb-1">買い出し</button>
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'caution']]) !!}
                                            {!! Form::submit('要注意',['name' => 'few','class'=>'btn btn-outline-warning btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'ok']]) !!}
                                            {!! Form::submit('在庫あり',['name' => 'many','class'=>'btn btn-outline-success btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                    @elseif($item->status == 1)
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'buy']]) !!}
                                            {!! Form::submit('買い出し',['name' => 'none','class'=>'btn btn-outline-danger btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                        <button type="button" class="btn btn-warning btn-sm mb-1">要注意</button>
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'ok']]) !!}
                                            {!! Form::submit('在庫あり',['name' => 'many','class'=>'btn btn-outline-success btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'buy']]) !!}
                                            {!! Form::submit('買い出し',['name' => 'none','class'=>'btn btn-outline-danger btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                        {!! Form::open(['method'=>'put','route'=>['items.status.update',$item->id,'caution']]) !!}
                                            {!! Form::submit('要注意',['name' => 'few','class'=>'btn btn-outline-warning btn-sm mb-1']) !!}
                                        {!! Form::close() !!}
                                        <button type="button" class="btn btn-success btn-sm mb-1">在庫あり</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>        
                </table>
        @endforeach
    @else
        <div class="center jumbotron">
            <div class="text-center">                
                <h3>さっそく商品を登録してみましょう！</h3>
                <p>(例) トマト、割り箸</p>
                <p class="text-danger">＜カテゴリー、買い出し先から先に登録してください＞</p>
                {{-- 買い出し先登録ページへのリンク --}}                    
                {!! link_to_route('items.create', '商品を新規作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
    
@endsection