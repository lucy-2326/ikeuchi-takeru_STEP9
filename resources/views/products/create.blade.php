@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">商品新規登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>
            <input type="text" name="product_name" id="product_name"
                   class="form-control @error('product_name') is-invalid @enderror"
                   value="{{ old('product_name') }}">

            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" name="price" id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price') }}">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>
            <input type="number" name="stock" id="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock') }}">

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" id="description"
                      class="form-control @error('description') is-invalid @enderror"
                      rows="4">{{ old('description') }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" name="img_path" id="img_path"
                   class="form-control @error('img_path') is-invalid @enderror">

            @error('img_path')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            登録
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            戻る
        </a>
    </form>

</div>
@endsection
