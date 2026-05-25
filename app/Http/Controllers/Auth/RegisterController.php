<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    use RegistersUsers;

    /**
     * ログイン後のリダイレクト先
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * コンストラクタ
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 会員登録処理
     */
    public function register(RegisterRequest $request)
    {
        // バリデーション済みデータ取得
        $validatedData = $request->validated();

        // ユーザー作成
        $user = $this->create($validatedData);

        // ログイン
        auth()->login($user);

        // リダイレクト
        return redirect($this->redirectPath());
    }

    /**
     * ユーザー作成
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
