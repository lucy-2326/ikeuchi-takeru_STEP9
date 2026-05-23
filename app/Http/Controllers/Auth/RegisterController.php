<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users',],

            'name_kanji' => ['required', 'string', 'max:255','regex:/^[一-龠々]+$/u',],

            'name_kana' => ['required', 'string', 'max:255','regex:/^[ァ-ヶー]+$/u',],

            'email' => [
            'required',
            'string',
            'email:rfc,dns',
            'max:255',
            'unique:users',],

            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^[a-zA-Z0-9]+$/',],

        ],[


            // ユーザー名
            'name.required' => 'ユーザー名を入力してください。',
            'name.unique' => 'このユーザー名は既に使用されています。',

            // 名前（漢字）
            'name_kanji.required' => '名前（漢字）を入力してください。',
            'name_kanji.regex' => '名前（漢字）は漢字のみで入力してください。',

            // 名前（カナ）
            'name_kana.required' => '名前（カナ）を入力してください。',
            'name_kana.regex' => '名前（カナ）はカタカナのみで入力してください。',

            // メール
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',

            // パスワード
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.regex' => 'パスワードは半角英数字で入力してください。',
            'password.confirmed' => 'パスワード再入力が一致していません。',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'name_kanji' => $data['name_kanji'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'company_id' => $data['company_id'],
        ]);
    }
}
