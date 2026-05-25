<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            // メール
            'email' => 'required|email:rfc,dns|max:255|regex:/^[a-zA-Z0-9@._\-]+$/',

            // パスワード
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            // メール
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'email.regex' => 'メールアドレスは半角英数字で入力してください',

            // パスワード
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ];
    }

}
