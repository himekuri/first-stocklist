@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item"><a href="/categories">カテゴリー一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">カテゴリー編集</li>
        </ol>
    </nav>
    
    <div class="col-md-6 text-center">
        <h3>カテゴリー編集</h3>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            {!! Form::model($category, ['route' => ['categories.update', $category->id ],'method' => 'put']) !!}
            
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            
                <div class="form-group">
                    {!! Form::label('number', '並び順',['class' => 'd-block']) !!}
                    {!! Form::select('number',App\Category::numbers(),['class' => 'form-control'] ) !!}

                </div>

                {!! Form::submit('編集', ['class' => 'btn btn-primary btn-block mt-5']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection