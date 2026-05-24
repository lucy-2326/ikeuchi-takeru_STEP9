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

        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',

                'name_kanji' => 'required|string|max:255|regex:/^[一-龠々\s]+$/u',

                'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー\s]+$/u',

                'email' => 'required|email:rfc,dns|max:255|regex:/^[a-zA-Z0-9@._\-]+$/|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'ユーザー名を入力してください',

                'name_kanji.required' => '名前（漢字）を入力してください',
                'name_kanji.regex' => '名前（漢字）は漢字のみで入力してください',

                'name_kana.required' => '名前（カナ）を入力してください',
                'name_kana.regex' => '名前（カナ）はカタカナのみで入力してください',

                'email.required' => 'メールアドレスを入力してください',
                'email.email' => '正しいメールアドレス形式で入力してください',
                'email.regex' => 'メールアドレスは半角英数字で入力してください',
                'email.unique' => 'このメールアドレスは既に使用されています',
            ]
        );

        $user->update($validatedData);

        return redirect()->route('mypage.index')
            ->with('success', 'アカウント情報を更新しました');
    }
}
