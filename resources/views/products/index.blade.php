@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<div class="container mt-5">

    <h1 class="mb-4">商品一覧</h1>

    @auth
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">
            商品登録
        </a>
    @endauth

    <form action="{{ route('products.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                    name="product_name"
                    class="form-control"
                    placeholder="商品名で検索"
                    value="{{ request('product_name') }}">
            </div>

            <div class="col-md-3">
                <input type="number"
                   name="min_price"
                   class="form-control"
                   placeholder="最低価格"
                   value="{{ request('min_price') }}">
            </div>

            <div class="col-md-3">
                <input type="number"
                    name="max_price"
                    class="form-control"
                    placeholder="最高価格"
                    value="{{ request('max_price') }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    検索
                </button>
            </div>
        </div>
    </form>

    @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        @forelse($products as $product)

            <div class="col-md-4 mb-4">
                <div class="card h-100">

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

                        <h5 class="card-title">
                            {{ $product->product_name }}
                        </h5>

                        <p class="card-text">
                            ¥{{ number_format($product->price) }}
                        </p>

                        <p class="card-text">
                            在庫：{{ $product->stock }}
                        </p>

                        <p class="card-text">
                            {{ $product->description }}
                        </p>

                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-primary">
                            詳細
                        </a>

                    </div>

                </div>
            </div>

        @empty

            <p>商品がありません</p>

        @endforelse

    </div>

</div>

@endsection
