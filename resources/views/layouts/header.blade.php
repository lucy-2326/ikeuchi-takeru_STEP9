<header class="border-bottom py-3 mb-4">
    <div class="container d-flex justify-content-between align-items-center">

        {{-- 左側 --}}
        <h3 class="m-0">Cytech EC</h3>

        {{-- 右側 --}}
        <div class="d-flex align-items-center gap-3">



            {{-- ログインしていない時 --}}
            @guest

                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                    ログイン
                </a>

                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                    新規登録
                </a>

            @endguest

            {{-- ログイン中 --}}
            @auth

                <a href="{{ route('products.index') }}">
                    Home
                </a>

                <a href="{{ route('mypage.index') }}">
                    マイページ
                </a>

                <span>
                    ログインユーザー：{{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger btn-sm">
                        ログアウト
                    </button>
                </form>
            @endauth

        </div>

    </div>
</header>
