<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductSearchRequest;

class ProductController extends Controller
{
    public function index(ProductSearchRequest $request)
    {
        $validatedData = $request->validated();

        $query = Product::query();

        if (auth()->check()) {
            $query->where('user_id', '!=', auth()->id());
        }

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $validatedData['product_name'] . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $validatedData['min_price']);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $validatedData['max_price']);
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }
    public function show(Product $product)
    {
        return view('products.show', compact('product'));

    }

    public function purchase(Product $product)
    {
        return view('products.purchase', compact('product'));
    }

    public function storePurchase(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        Sale::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('products.index')->with('success', '購入が完了しました');
    }

    public function create()
    {
         return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('images', 'public');
            $validatedData['img_path'] = $imagePath;
        } else {
            $validatedData['img_path'] = '';
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['company_id'] = auth()->user()->company_id;

        Product::create($validatedData);

        return redirect()->route('mypage.index')->with('success', '商品を登録しました');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('images', 'public');
            $validatedData['img_path'] = $imagePath;
        }

        $product->update($validatedData);

        return redirect()->route('mypage.index')->with('success', '商品を更新しました');
    }

    public function destroy(Product $product)
    {
        if (auth()->id() !== $product->user_id) {
        abort(403);
        }

        $product->delete();

        return redirect()->route('mypage.index')
            ->with('success', '商品を削除しました');
    }

    public function myProductShow(Product $product)
    {
        if (auth()->id() !== $product->user_id) {
            abort(403);
        }

        return view('products.my_show', compact('product'));
    }
}
