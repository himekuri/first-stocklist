@extends('layouts.app')
@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">商品一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">買い出しリスト</li>
        </ol>
    </nav>
    <div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url= {{ route('users.autoLogin', ['token' => \Auth::user()->secret_token]) }} data-color="default" data-size="large" data-count="false" style="display: none;"></div>
    @if (count($items)>0)
        <form method="post" action="{{ route('lists.store') }}">
            @csrf
            @foreach ($shops as $shop)
                <div class="bg-secondary text-white pl-2">{{$shop->name}}</div>
                <table class="table">
                    <tbody>
                        @foreach($shop->items->whereIn('status',[1,2]) as $item)
                            <tr> 
                                {{-- 買い出し先名を押すと編集ページへ飛ぶ --}}                                    
                                <td class="align-middle">{{$item->name}}</td>
                                @if($item->status == 2)
                                    <td class="align-middle">
                                        <div class="btn btn-danger rounded-pill">買い出し</div>
                                    </td>
                                @else
                                    <td class="align-middle">
                                        <div class="btn btn-warning rounded-pill">要注意</div>
                                    </td>                                    
                                @endif
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
    @else
        <div class="center jumbotron">
            <div class="text-center">                
                <h3>買い出しはありません</h3>
            </div>
        </div>
    @endif
    
@endsection