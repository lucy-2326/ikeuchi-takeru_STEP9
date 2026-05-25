<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // ユーザー名
            'name' => 'required|string|max:255',

            // 名前（漢字）
            'name_kanji' => 'required|string|max:255|regex:/^[一-龠々\s]+$/u',

            // 名前（カナ）
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー\s]+$/u',

            // メール
            'email' => 'required|email:rfc,dns|max:255|regex:/^[a-zA-Z0-9@._\-]+$/|unique:users,email',

            // パスワード
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            // ユーザー名
            'name.required' => 'ユーザー名を入力してください',

            // 名前（漢字）
            'name_kanji.required' => '名前（漢字）を入力してください',
            'name_kanji.regex' => '名前（漢字）は漢字のみで入力してください',

            // 名前（カナ）
            'name_kana.required' => '名前（カナ）を入力してください',
            'name_kana.regex' => '名前（カナ）はカタカナのみで入力してください',

            // メール
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'email.regex' => 'メールアドレスは半角英数字で入力してください',
            'email.unique' => 'このメールアドレスは既に使用されています',

            // パスワード
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => '確認用パスワードが一致しません',
        ];
    }
}
