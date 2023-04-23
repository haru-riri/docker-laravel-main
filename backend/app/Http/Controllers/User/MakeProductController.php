<?php
// 商品作成用コントローラ
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MakeProductController extends Controller
{
    public function store(Request $request,$shop)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ],
        [
            'name.required' => '商品名を入力してください。',
            'description.required'  => '商品説明を入力してください。',
            'price.required' => '価格を入力してください。',
            'stock.required' => '在庫を入力してください。',
            'image.required' => '画像を選択してください。'
        ]);

        // アップロードされたファイルの取得
        $image = $request->file('image');
        // ファイルの保存とパスの取得
        $path = isset($image) ? $image->store('products', 'public') : '';

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->shop_id = $shop;
        $product->image = $path;
        $product->save();

        return redirect()->route('shops.show', compact('shop'));
    }

    public function show(Product $product, Shop $shop)
    {
        return view('products.show', compact('product', 'shop'));
    }

}
