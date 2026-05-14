@extends('layouts.app')

@section('title', '商品詳細')

@section('content')

<div class="container mt-5">

    <h1 class="mb-4">商品詳細</h1>

    <div class="card">

        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}"
                 class="card-img-top"
                 alt="商品画像">
        @else
            <div class="bg-light text-center p-5">
                No Image
            </div>
        @endif

        <div class="card-body">

            <h2 class="card-title mb-3">
                {{ $product->product_name }}
            </h2>

            <p class="card-text">
                <strong>価格：</strong>
                ¥{{ number_format($product->price) }}
            </p>

            <p class="card-text">
                <strong>在庫：</strong>
                {{ $product->stock }}
            </p>

            <p class="card-text">
                <strong>説明：</strong>
                {{ $product->description }}
            </p>

            <a href="{{ route('products.purchase', $product) }}"
               class="btn btn-success">
                購入する
            </a>

            @auth
                @if(auth()->id() === $product->user_id)
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning mb-3">
                        編集
                    </a>
                @endif
            @endauth

            @auth

                @if(auth()->id() === $product->user_id)
                    <form action="{{ route('products.destroy', $product) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('本当に削除しますか？');">

                      @csrf
                      @method('DELETE')

                      <button type="submit" class="btn btn-danger mb-3">
                         削除
                      </button>
                    </form>
                @endif
            @endauth

            <form action="{{ route('products.like', $product) }}"
                  method="POST"
                  class="mb-3 mt-3">

                @csrf

                <button type="submit" class="btn btn-danger">
                    お気に入り追加
                </button>

            </form>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                戻る
            </a>

        </div>

    </div>

</div>

@endsection
