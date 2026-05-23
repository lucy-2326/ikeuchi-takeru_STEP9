@extends('layouts.app')

@section('title', 'アカウント編集')

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

    <h1 class="mb-4">アカウント編集</h1>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('account.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">ユーザー名</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">名前(漢字)</label>

                    <input type="text"
                           name="name_kanji"
                           class="form-control"
                           value="{{ old('name_kanji', $user->name_kanji) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">名前(カナ)</label>

                    <input type="text"
                           name="name_kana"
                           class="form-control"
                           value="{{ old('name_kana', $user->name_kana) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">メールアドレス</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}">
                </div>

                <button type="submit" class="btn btn-primary">
                    更新する
                </button>

                <a href="{{ route('mypage.index') }}"
                   class="btn btn-secondary">
                    戻る
                </a>

            </form>

        </div>

    </div>

</div>

@endsection
