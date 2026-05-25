<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
        $user = auth()->user();

        return [
            // ユーザー名：すべての文字OK
            'name' => 'required|string|max:255',

            // 名前（漢字）：漢字のみ
            'name_kanji' => 'required|string|max:255|regex:/^[一-龠々\s]+$/u',

            // 名前（カナ）：カタカナのみ
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー\s]+$/u',

            // メール：メール形式 + 半角英数字
            'email' => 'required|email:rfc,dns|max:255|regex:/^[a-zA-Z0-9@._\-]+$/|unique:users,email,' . $user->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ユーザー名を入力してください',

            'name_kanji.required' => '名前（漢字）を入力してください',
            'name_kanji.regex' => '名前（漢字）は漢字のみで入力してください',

            'name_kana.required' => '名前（カナ）を入力してください',
            'name_kana.regex' => '名前（カナ）はカタカナのみで入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '正しいメールアドレス形式で入力してください',
            'email.regex' => 'メールアドレスは半角英数字で入力してください',
            'email.unique' => 'このメールアドレスは既に使用されています',
        ];
    }

}
