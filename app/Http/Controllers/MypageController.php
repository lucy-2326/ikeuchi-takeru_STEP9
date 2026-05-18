<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

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

    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('mypage.index')
            ->with('success', 'アカウント情報を更新しました');
    }
}
