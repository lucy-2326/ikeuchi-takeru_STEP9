@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">マイページ</h1>

    <div class="card mb-4">
        <div class="card-header">ユーザー情報</div>

        <div class="card-body">
            <p><strong>ユーザー名：</strong>{{ $user->name }}</p>
            <p><strong>名前（漢字）：</strong>{{ $user->name_kanji }}</p>
            <p><strong>名前（カナ）：</strong>{{ $user->name_kana }}</p>
            <p><strong>メール：</strong>{{ $user->email }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">購入履歴</div>

        <div class="card-body">

            @forelse($sales as $sale)
                <div class="border-bottom mb-3 pb-3">
                    <p><strong>商品名：</strong>{{ $sale->product->product_name }}</p>
                    <p><strong>購入数：</strong>{{ $sale->quantity }}</p>
                    <p><strong>購入日：</strong>{{ $sale->created_at }}</p>
                </div>
            @empty
                <p>購入履歴はありません。</p>
            @endforelse

        </div>
    </div>

    <div class="card mt-4">
      <div class="card-header">お気に入り一覧</div>

      <div class="card-body">

        @forelse($likes as $like)
            <div class="border-bottom mb-3 pb-3">
                <p><strong>商品名：</strong>{{ $like->product->product_name }}</p>
                <p><strong>価格：</strong>¥{{ number_format($like->product->price) }}</p>

                <a href="{{ route('products.show', $like->product) }}" class="btn btn-primary">
                    詳細
                </a>
            </div>
        @empty
            <p>お気に入りはありません。</p>
        @endforelse

      </div>
   </div>

</div>
@endsection
