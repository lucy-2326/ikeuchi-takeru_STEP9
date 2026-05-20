<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Product $product)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
        ]);
    }
}
