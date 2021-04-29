@extends('layouts.app')

@section('content')
    <!-- トップ -->
    <div class="center jumbotron">
        <div class="text-center">
            <h1>買い出しをもっとスムーズに！</h1>
            <p>Stock List は店舗の在庫チェックから買い物リストの作成が簡単にできるサービスです。</p>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-warning']) !!}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-success']) !!}
        </div>
    </div>
	<!-- サービスの説明 -->
	<section class="text-center">
		<h5 class="my-5">〜 Stock List で できること 〜</h5>
		<div class="container">
			<div class="row">
				<section class="col-lg-4 mb-5">
					<p><img class="img-fluid" src="img/category.png" width="500" height="500" alt="category"></p>
					<p class="feature-title">1. 食材や備品の登録</p>
					<p>「野菜」などのカテゴリーや買い出し先を設定することができます</p>
				</section>
				<section class="col-lg-4 mb-5">
					<p><img class="img-fluid" src="img/check.png" width="500" height="500" alt="check-stock"></p>
					<p class="feature-title">2. 在庫チェック</p>
					<p>在庫の状況を「買い出し」「要注意」「在庫あり」の３つから選ぶことができます</p>
				</section>
				<section class="col-lg-4 mb-5">
					<p><img class="img-fluid" src="img/check-list.png" width="500" height="500" alt="check-list"></p>
					<p class="feature-title">3. 買い出しリスト</p>
					<p>在庫状況や買い出し先は自動的に買い出しリストに反映されます</p>
				</section>
			</div>
		</div>
	</section>
	<!-- 新規登録・ログインへの誘導 -->
	<section class="text-center border-top border-secondary py-5">
		<p>無料で店舗アカウントを作成しよう！</p>
		{!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-warning']) !!}
        {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-success']) !!}
	</section>
    
@endsection