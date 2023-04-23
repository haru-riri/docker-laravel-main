@extends('layouts.app')

@section('content')
<main class="main">
    <div class="link">
        <a href="{{ route('shops.index') }}">ショップ一覧へ</a>
    </div>

    <div class="link">
        <a href="{{ route('shops.show',$product->shop_id) }}">ショップ詳細に戻る</a>
    </div>

    <div style="margin-top: 20px; margin-bottom: 10px;">
        <h5>商品情報</h5>
    </div>

    <div style="margin-bottom: 20px">
        <h2>{{$product->name}}</h2>
    </div>

    <div>
        <div>
        <img src="{{ Storage::url($product->image)}}" width="500px">
        </div>

        <table class="mt-3 table">
            <tr>
                <th>この商品について:</th><td><p style="white-space: pre-wrap;">{{$product->description}}</p></td>
            </tr>
            <tr>
                <th>価格:</th><td>￥{{$product->price}} <small style="color:gray; font-size: 11px;"> 税込</small></td>
            </tr>
            <tr>
                <th>在庫:</th><td>{{$product->stock}} </td>
            </tr>
        </table>
    </div>

    <div>
        {{-- 在庫状況 --}}
        <strong>{{ $message }}</strong>
    </div>

    <div class="mt-2">
        @if($product->stock === 0)
            <form method="POST">
                @csrf
            <input type="submit" name="button1" class="btn btn-info" value="購入" disabled>
            </form>
        @else
            <form method="POST">
                @csrf
            <input type="submit" name="button1"  class="btn btn-info" value="購入">
            </form>
        @endif
            


    </div>
    
    @can('owner')
    {{-- ログインしているユーザー情報を取得 usersのidとshopのadmin_idが一致する場合編集ボタンを表示 --}}
    @if($product->shop_id === $shop_user_id )
    <div class="mt-3">
        <form method="POST" action="/download/{{ $product->id }}">
            @csrf
            <p class="d-inline">商品データの出力: </p>
            <a href="{{ route('download.index', $product->id) }}">CSV出力</a>
        </form>
    </div>

    <div>
        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
            @csrf
            <div>
                <p class="d-inline">商品データの編集: </p>
                <a href="{{ route('product.edit',$product->id) }}">編集</a>
            </div>

            
            @method('DELETE')
            <div　class="mt-2">
                <button type="submit" class="btn btn-info">商品削除</button>
            </div>
        </form>
    </div>
    @endif
    @endcan
    
</main>
@endsection