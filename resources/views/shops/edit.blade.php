@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item"><a href="/shops">買い出し先ー一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">買い出し先編集</li>
        </ol>
    </nav>
    
    <div class="col-md-6 text-center">
        <h3>買い出し先編集</h3>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($shop, ['route' => ['shops.update',$shop->id],'method' => 'put']) !!}
            
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    {!! Form::label('number', '並び順',['class' => 'd-block']) !!}
                    {!! Form::select('number',App\Category::numbers(),['class' => 'form-control'] ) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('gmap_url', 'GoogleMapのURL（任意）') !!}
                    {!! Form::text('gmap_url', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('編集', ['class' => 'btn btn-primary btn-block mt-5']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection