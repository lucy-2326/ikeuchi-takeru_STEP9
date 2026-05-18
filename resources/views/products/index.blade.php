@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">商品一覧</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 検索フォーム --}}
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

    @auth
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">
            商品登録
        </a>
    @endauth

    <table class="table table-bordered align-middle">

        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(¥)</th>
                <th></th>
            </tr>
        </thead>

        <tbody>

            @forelse($products as $product)

                <tr>

                    <td>{{ $product->id }}</td>

                    <td>{{ $product->product_name }}</td>

                    <td>{{ $product->description }}</td>

                    <td>
                        @if($product->img_path)

                            <img src="{{ asset('storage/' . $product->img_path) }}"
                                alt="商品画像"
                                width="50"
                                height="50"
                                style="object-fit: cover;">

                        @else

                            画像なし

                        @endif
                    </td>

                    <td>
                        ¥{{ number_format($product->price) }}
                    </td>

                    <td>
                        <a href="{{ route('products.show', $product) }}"
                            class="btn btn-success btn-sm">
                            詳細
                        </a>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        商品がありません。
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection
