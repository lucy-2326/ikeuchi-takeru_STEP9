<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Like;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $sales = Sale::where('user_id', $user->id)
            ->with('product')
            ->get();

        $likes = Like::where('user_id', $user->id)
            ->with('product')
            ->get();

        return view('mypage.index', compact('user', 'sales', 'likes'));
    }
}
