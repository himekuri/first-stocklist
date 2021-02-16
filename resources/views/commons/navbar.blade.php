<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark nav.sticky-top">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Stocklist</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- メニュー項目 -->
        <div class="collapse navbar-collapse" id="nav-bar">
            @if (Auth::check())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">{!! link_to_route('items.index', '商品一覧', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('categories.index', 'カテゴリー', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('shops.index', '買い出し先', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('lists.index', '買い出しリスト', [], ['class' => 'nav-link']) !!}</li>
                </ul>
                <ul class="navbar-nav">
                    <li class="dropdown-divider"></li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                </ul>
            @else
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav">
                    {{-- アカウント登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'アカウント登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                </ul>
            @endif
        </div>
    </nav>
</header>