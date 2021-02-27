@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">検索結果</li>
        </ol>
    </nav>
    {!! Form::open(['method'=>'get','route'=>['items.serch']]) !!}
        <div class="input-group mb-3 col-md-10 ">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'商品を検索']) !!}
            <div class="input-group-append">                    
                {!! Form::submit('検索',['class'=>'btn btn-primary']) !!}            
            </div>
        </div>
    {!! Form::close() !!}
    
    @if (count($items)>0)
        <table class="table">
            <tbody>                
                @foreach($items as $item)
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
    @else
        <div class="text-center">                
            <p>検索結果はありません</p>
        </div>
    @endif


@endsection