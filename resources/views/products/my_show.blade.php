@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-5">出品商品詳細</h1>

    <div class="mb-4">
        <p class="fs-4">
            商品名：{{ $product->product_name }}
        </p>

        <p class="fs-4">
            説明：{{ $product->description }}
        </p>
    </div>

    <div class="mb-4">
        <p class="fs-4">画像：</p>

        @if($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}"
                 alt="商品画像"
                 style="width: 420px; height: 320px; object-fit: contain;">
        @else
            <div class="bg-light text-center p-5" style="width: 420px;">
                画像なし
            </div>
        @endif
    </div>

    <div class="mb-4">
        <p class="fs-4">
            金額：¥{{ number_format($product->price) }}
        </p>
    </div>

    <a href="{{ route('products.edit', $product) }}"
       class="btn btn-primary btn-lg">
        編集
    </a>

    <form action="{{ route('products.destroy', $product) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger btn-lg">
            削除する
        </button>
    </form>

    <a href="{{ route('mypage.index') }}"
       class="btn btn-secondary btn-lg">
        戻る
    </a>

</div>

@endsection
