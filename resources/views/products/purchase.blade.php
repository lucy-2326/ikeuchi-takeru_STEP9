@extends('layouts.app')

@section('title', '購入画面')

@section('content')

<div class="container mt-5">

    @if ($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <h1 class="mb-4">購入画面</h1>

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

            <p>
                <strong>価格：</strong>
                ¥{{ number_format($product->price) }}
            </p>

            <p>
                <strong>在庫：</strong>
                {{ $product->stock }}
            </p>

            <p>
                <strong>説明：</strong>
                {{ $product->description }}
            </p>

            <form action="{{ route('products.purchase.store', $product) }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label for="quantity" class="form-label">
                        購入数量
                    </label>

                    <input type="number"
                           name="quantity"
                           id="quantity"
                           class="form-control"
                           min="1"
                           max="{{ $product->stock }}"
                           value="1">
                </div>

                <button type="submit" class="btn btn-primary">
                    購入する
                </button>

                <a href="{{ route('products.show', $product) }}"
                   class="btn btn-secondary">
                    戻る
                </a>

            </form>

        </div>

    </div>

</div>

@endsection
