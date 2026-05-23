@extends('layouts.app')

@section('title', '商品編集')

@section('content')
<div class="container">

     @if ($errors->any())
        <div class="alert alert-danger">

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <h1 class="mb-4">商品編集</h1>

    <form action="{{ route('products.update', $product) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>

            <input type="text"
                   name="product_name"
                   id="product_name"
                   class="form-control @error('product_name') is-invalid @enderror"
                   value="{{ old('product_name', $product->product_name) }}">

            @error('product_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格</label>

            <input type="number"
                   name="price"
                   id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price) }}">

            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>

            <input type="number"
                   name="stock"
                   id="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $product->stock) }}">

            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>

            <textarea name="description"
                      id="description"
                      rows="4"
                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>

            <input type="file"
                   name="img_path"
                   id="img_path"
                   class="form-control @error('img_path') is-invalid @enderror">

            @error('img_path')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        @if($product->img_path)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $product->img_path) }}"
                     width="200"
                     class="img-thumbnail">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">
            更新
        </button>

        <a href="{{ route('mypage.products.show', $product) }}"
           class="btn btn-secondary">
            戻る
        </a>

    </form>

</div>
@endsection
