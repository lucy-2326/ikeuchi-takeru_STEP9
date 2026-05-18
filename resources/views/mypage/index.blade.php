@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-4">マイページ</h1>

    <a href="{{ route('account.edit') }}" class="btn btn-primary mb-3">
    アカウント編集
    </a>

    <div class="card mb-4">
        <div class="card-header">ユーザー情報</div>

        <div class="card-body">
            <p><strong>ユーザー名：</strong>{{ $user->name }}</p>
            <p><strong>名前（漢字）：</strong>{{ $user->name_kanji }}</p>
            <p><strong>名前（カナ）：</strong>{{ $user->name_kana }}</p>
            <p><strong>メール：</strong>{{ $user->email }}</p>
        </div>
    </div>


        {{-- 出品商品一覧 --}}
    <div class="card mb-5">

        <div class="card-header d-flex justify-content-between align-items-center">
            <span>出品商品一覧</span>

            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                新規登録
            </a>
        </div>


        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>商品番号</th>
                        <th>商品名</th>
                        <th>商品説明</th>
                        <th>料金(¥)</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($myProducts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>
                                <a href="{{ route('mypage.products.show', $product) }}" class="btn btn-success btn-sm">
                                詳細
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">出品商品はありません。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- 購入履歴 --}}
<div class="card mb-5">

    <div class="card-header">
        購入履歴
    </div>

    <div class="card-body">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(¥)</th>
                    <th>個数</th>
                </tr>
            </thead>

            <tbody>

                @forelse($sales as $sale)

                    <tr>
                        <td>{{ $sale->product->product_name }}</td>

                        <td>{{ $sale->product->description }}</td>

                        <td>
                            {{ number_format($sale->product->price) }}
                        </td>

                        <td>{{ $sale->quantity }}</td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4">
                            購入履歴はありません。
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



</div>



@endsection
