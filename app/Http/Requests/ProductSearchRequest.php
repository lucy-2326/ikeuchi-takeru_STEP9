<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
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
            'product_name' => 'nullable|string|max:255',
            'min_price' => 'nullable|integer|min:1',
            'max_price' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.string' => '商品名は文字で入力してください',
            'product_name.max' => '商品名は255文字以内で入力してください',

            'min_price.integer' => '最低価格は数字で入力してください',
            'min_price.min' => '最低価格は0以上で入力してください',

            'max_price.integer' => '最高価格は数字で入力してください',
            'max_price.min' => '最高価格は0以上で入力してください',
        ];
    }
}
