@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">買い出し先一覧</li>
        </ol>
    </nav>
    <div class="mb-3 text-right">
        <a href="/shops/create" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    {{-- 買い出し先一覧を表示する --}}
    @if (count($shops)>0)
        <table class="table">
            <tbody>
                @foreach ($shops as $shop)
                    <tr>                        
                        {{-- 買い出し先名を押すと編集ページへ飛ぶ --}}
                        <td class="align-middle">{!! link_to_route('shops.edit', $shop->name, ['shop' => $shop->id]) !!}</td>
                        @if(empty($shop->gmap_url))
                            <td class="small align-bottom">GoogleMapは未登録です</td>
                        @else
                            <td class="small align-bottom">{!! link_to_route('gmap', 'GoogleMapを表示', ['id' => $shop->id]) !!}</td>
                        @endif
                        
                        <td>
                            {!! Form::model($shop, ['route' => ['shops.destroy', $shop->id], 'method' => 'delete']) !!}
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
                <h3>さっそく買い出し先を登録してみましょう！</h3>
                <p>(例) スーパーA、薬局</p>
                {{-- 買い出し先登録ページへのリンク --}}                    
                {!! link_to_route('shops.create', '買い出し先を新規作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection