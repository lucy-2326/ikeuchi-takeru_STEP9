<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $validatedData = $request->validate(
            [
                // 名前
                'name' => [
                    'required',
                    'string',
                    'max:255',

                    // 漢字・ひらがな・カタカナ・全角半角英字・スペース許可
                    'regex:/^[ぁ-んァ-ヶー一-龠々a-zA-Zａ-ｚＡ-Ｚ\s　]+$/u',
                ],

                // メールアドレス
                'email' => [
                    'required',
                    'string',
                    'max:255',

                    // メールアドレス形式
                    'email:rfc,dns',

                    // 半角英数字のみ許可
                    'regex:/^[a-zA-Z0-9@._\-]+$/',
                ],

                // お問い合わせ内容
                'message' => [
                    'required',
                    'string',
                    'max:1000',
                ],
            ],

            // エラーメッセージ
            [
                // 名前
                'name.required' => '名前を入力してください',
                'name.regex' => '名前は漢字・ひらがな・カタカナ・英字で入力してください',

                // メール
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => '正しいメールアドレス形式で入力してください',
                'email.regex' => 'メールアドレスは半角英数字で入力してください',

                // お問い合わせ内容
                'message.required' => 'お問い合わせ内容を入力してください',
                'message.max' => 'お問い合わせ内容は1000文字以内で入力してください',
            ]
        );

        Mail::to('admin@example.com')->send(new ContactMail($validatedData));

        return redirect()->route('products.index')
            ->with('success', 'お問い合わせを送信しました');
    }
}
