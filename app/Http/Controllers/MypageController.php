<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\AccountUpdateRequest;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $myProducts = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        $sales = Sale::where('user_id', $user->id)
            ->with('product')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.index', compact('user', 'myProducts', 'sales'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('mypage.edit', compact('user'));
    }


    public function update(AccountUpdateRequest $request)
    {
        $user = auth()->user();

        $validatedData = $request->validated();

        $user->update($validatedData);

        return redirect()->route('mypage.index')
            ->with('success', 'アカウント情報を更新しました');
    }
}
