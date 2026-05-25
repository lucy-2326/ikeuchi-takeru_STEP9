<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',

            'email' => 'required|email:rfc,dns|max:255|regex:/^[a-zA-Z0-9@._\-]+$/',

            'message' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '名前を入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'email.regex' => 'メールアドレスは半角英数字で入力してください',

            'message.required' => 'お問い合わせ内容を入力してください',
            'message.max' => 'お問い合わせ内容は1000文字以内で入力してください',
        ];
    }
}
