<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// <機能一覧> index: すべてのショップの一覧を表示 show: 店舗詳細に移動

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();

	    return view('shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('shops.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ],
        [
            'name.required' => 'ショップ名を入力してください。',
            'description.required'  => 'ショップ説明を入力してください。',
            'image.required' => '画像を選択してください。'
        ]);
        
        // アップロードされたファイルの取得
        $image = $request->file('image');
        // ファイルの保存とパスの取得
        $path = isset($image) ? $image->store('shops', 'public') : '';

        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->admin_id = Auth::id();
        $shop->image = $path;

        $shop->save();

        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $id = Auth::id();
        $products = Product::all();
        return view('shops.show', compact('shop', 'id', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, User $user)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image'
        ],
        [
            'name.required' => 'ショップ名を入力してください。',
            'description.required'  => 'ショップ説明を入力してください。',
            'image.required' => '画像を選択してください。'
        ]);

        $image = $request->file('image');
        $path = isset($image) ? $image->store('shops', 'public') : '';

        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->admin_id = Auth::id();
        $shop->image = $path;
        $shop->update();
 
        return redirect()->route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
  
        return redirect()->route('shops.index');
    }
}
