@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">商品一覧</li>
        </ol>
    </nav>
    <div class="mb-3 text-right">
        <a href="/items/create" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    
    <div class="center jumbotron">
        <div class="text-center">
            <h1>商品一覧ダミー</h1>
        </div>
    </div>
@endsection