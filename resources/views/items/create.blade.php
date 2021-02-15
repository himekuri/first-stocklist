@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">商品登録</li>
        </ol>
    </nav>
    
    <div class="col-md-6 text-center">
        <h3>商品登録</h3>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($item, ['route' => 'items.store']) !!}
            
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('', 'カテゴリー',['class' => 'd-block']) !!}
                    @foreach ($categories as $category)
                    {{ Form::radio('category_id', null, false, ['category_id' => $category->id]) }}
                    {!! Form::label('category_id', $category->name) !!}
                    @endforeach
                </div>
                
                <div class="form-group">
                    {!! Form::label('', '買い出し先',['class' => 'd-block']) !!}
                    @foreach ($shops as $shop)
                    {{ Form::radio('shop_id', null, false, ['shop_id' => $shop->id]) }}
                    {!! Form::label('category_id', $shop->name) !!}
                    @endforeach
                </div>
                

                {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block mt-5']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection