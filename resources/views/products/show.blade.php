@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h1 class="mb-5">商品詳細</h1>

    {{-- 商品名・説明 --}}
    <div class="mb-5">
        <p class="fs-4 mb-2">商品名：{{ $product->name }}</p>
        <p class="fs-4">説明：{{ $product->description }}</p>
    </div>

    {{-- 商品画像 --}}
    <div class="mb-4">
        <p class="fs-4">画像：</p>

        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}"
                 alt="商品画像"
                 style="max-width: 500px; width: 100%; display: block; margin: 0 auto;">
        @else
            <div class="bg-light text-center p-5">
                No Image
            </div>
        @endif
    </div>

    {{-- 金額・会社・お気に入り --}}
    <div class="mb-4">
        <p class="fs-4 mb-2">金額：￥{{ $product->price }}</p>
        <p class="fs-4 mb-2">会社：{{ $product->company }}</p>

        @auth
            <form action="{{ route('products.like', $product) }}" method="POST">
                @csrf

                <button type="submit"
                    style="border:none; background:none; font-size:40px; padding:0;">
                    @if($product->isLikedByUser())
                        <span style="color:red;">♥</span>
                    @else
                        <span style="color:black;">♡</span>
                    @endif
                </button>
            </form>
        @endauth
    </div>

    {{-- ボタン横並び --}}
    <div class="d-flex gap-2 mb-5">
        <a href="{{ route('products.purchase', $product) }}"
            class="btn btn-primary btn-lg">
                カートに追加する
        </a>

        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
            戻る
        </a>
    </div>

</div>
@endsection
