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
                    <li class="nav-item"><a href="#" class="nav-link">商品一覧</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">カテゴリー</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">買い出し先</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">買い出しリスト</a></li>
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