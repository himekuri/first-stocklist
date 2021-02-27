@extends('layouts.app')
@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">買い出しリスト</li>
        </ol>
    </nav>
    <div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url= {{ route('users.autoLogin', ['token' => \Auth::user()->secret_token]) }} data-color="default" data-size="large" data-count="false" style="display: none;"></div>
    
    {{-- 表示の絞り込み機能 --}}
    <div class = "form-group k">
        <button type="button" class="btn btn-danger btn-sm mb-1">買い出しのみ</button>
        {!! link_to_route('lists.index', '要注意も含む', [], ['class' => 'btn btn-outline-warning btn-sm mb-1']) !!}
    </div>
    
    {{-- 買い出しがあるとき買い出し先ごとに一覧で表示する --}}
    @if (count($items)>0)
        <form method="post" action="{{ route('lists.update') }}">
            @csrf
            @method('put')
            @foreach ($shops as $shop)
                {{-- 買い出し先の名前を表示する --}}
                <div class="bg-secondary text-white pl-2">{{$shop->name}}</div>
                <table class="table">
                    <tbody>
                        @foreach($shop->items->whereIn('status',[2]) as $item)
                            <tr> 
                                <td class="align-middle">{{$item->name}}</td>
                                {{-- 買い出しのマークを表示する --}}
                                <td class="align-middle">
                                    <div class="btn btn-danger rounded-pill">買い出し</div>
                                </td>
                                <td>
                                    <div class="form-check ">
                                        <input class="form-check-input position-static" type="checkbox" name="cheked_item[]" value= {{$item->id}} >
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>        
                </table>
            @endforeach
            <div class="border-top pt-2">
                    <p class="text-center">チェックを反映する</p>
                    <button type="submit" name="store" value="submit" class="btn btn-lg btn-primary mx-auto d-block">反映</button>
            </div>
        </form>
    {{-- 買い出しがないとき「買い出しはありません」と表示 --}}
    @else
        <div class="center jumbotron">
            <div class="text-center">                
                <h3>買い出しはありません</h3>
            </div>
        </div>
    @endif
    
@endsection