<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, Product $product, Request $request)
    {
        $product_stock = $product->stock;
        if($product_stock === 0){
            $message = 'SOLD OUT';
        }else{
            $message = '在庫あり';
        }     
        // 一般ユーザー用にshop_user_idを定義
        $shop_user_id = '';

        // ユーザー情報を取得
        $user_id = auth()->id();

        // ショップの全情報を取得
        $shops = Shop::all();
        // 1つずつショップの情報を取り出す
        foreach($shops as $shop){
            // ショップの登録者id情報とログイン中のユーザー情報が同じであれば
            if($shop->admin_id === $user_id){
                // ショップと商品の関係を確認する
                if($shop->id === $product->shop_id){
                    // ショップのid情報を変数に渡す
                    $shop_user_id = $shop->id;
                }
            }
        }
        return view('product.show', compact('shop', 'product', 'message', 'shop_user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Shop $shop, Request $request)
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
            'price.required' => '値段を入力してください。',
            'stock.required' => '在庫を入力してください。',
            'image.required' => '画像を選択してください。'
        ]);

        $image = $request->file('image');
        $path = isset($image) ? $image->store('products', 'public') : '';

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->image = $path;
        $product->update();

        $product_stock = $product->stock;
        if($product_stock === 0){
            $message = 'SOLD OUT';
        }else{
            $message = '在庫あり';
        }     

        // 一般ユーザー用にshop_user_idを定義
        $shop_user_id = '';

        // ユーザー情報を取得
        $user_id = auth()->id();

        // ショップの全情報を取得
        $shops = Shop::all();
        // 1つずつショップの情報を取り出す
        foreach($shops as $shop){
            // ショップの登録者id情報とログイン中のユーザー情報が同じであれば
            if($shop->admin_id === $user_id){
                // ショップと商品の関係を確認する
                if($shop->id === $product->shop_id){
                    // ショップのid情報を変数に渡す
                    $shop_user_id = $shop->id;
                }
            }
        }
 
        return view('product.show', compact('shop', 'product', 'message', 'shop_user_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shops, Product $product)
    {
        $product->delete();
        $shops = Shop::all();
  
        return view('shops.index', compact('shops'));
    }

    // 商品購入ボタン用
    public function BuyButton(Product $product, Request $request) {

        $request->session()->regenerateToken();

          if($request->has('button1')) {
            $product->stock--;
            $product->update();
        }

        $product_stock = $product->stock;
        if($product_stock === 0){
            $message = 'SOLD OUT';
        }else{
            $message = '在庫あり';
        }     

        // 一般ユーザー用にshop_user_idを定義
        $shop_user_id = '';

        // ユーザー情報を取得
        $user_id = auth()->id();
        
        // ショップの全情報を取得
        $shops = Shop::all();
        // 1つずつショップの情報を取り出す
        foreach($shops as $shop){
            // ショップの登録者id情報とログイン中のユーザー情報が同じであれば
            if($shop->admin_id === $user_id){
                // ショップと商品の関係を確認する
                if($shop->id === $product->shop_id){
                    // ショップのid情報を変数に渡す
                    $shop_user_id = $shop->id;
                }
            }
        }
        return view('product.show', compact('product', 'message', 'shop_user_id'));
    }
        
}


