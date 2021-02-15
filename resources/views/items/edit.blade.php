@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">商品編集</li>
        </ol>
    </nav>
    
    <div class="col-md-6 text-center">
        <h3>商品編集</h3>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($item, ['route' => 'items.update',$item->id],'method' => 'put') !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    {!! Form::label('category_id', 'カテゴリー',['class' => 'd-block']) !!}
                    {!! Form::select('category_id',App\Category::numbers(),['class' => 'form-control'] ) !!}

                </div>
                
                <div class="form-group">
                    {!! Form::label('shop_id', '買い出し先',['class' => 'd-block']) !!}
                    {!! Form::select('shop_id',App\Category::numbers(),['class' => 'form-control'] ) !!}

                </div>

                {!! Form::submit('編集', ['class' => 'btn btn-primary btn-block mt-5']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection