@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="mb-4">お問い合わせフォーム</h1>

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">名前</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">お問い合わせ内容</label>
            <textarea name="message" class="form-control" rows="6">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            送信
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            戻る
        </a>
    </form>

</div>

@endsection
