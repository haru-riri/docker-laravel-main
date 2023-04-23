 @extends('layouts.app')

@section('content')
<main class="main">

    <div class="link">
        <a href="{{ route('product.show', $product->id) }}">商品詳細に戻る</a>
    </div>

    <div class="mt-3">
        <h4>商品の編集</h4>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <table class="table w-50">
                <tr>
                    <th>商品名:</th><td><input type="text" name="name" class="input_form" value="{{ $product->name }}" placeholder="商品名"></td>
                </tr>
                <tr>
                    <th>商品説明:</th><td><textarea style="height:150px" name="description" class="input_form" placeholder="商品説明">{{ $product->description }}</textarea></td>
                </tr>
                <tr>
                    <th>画像:</th><td><input id="image" type="file" name="image"></td>
                </tr>
                <tr>
                    <th>値段:</th><td><input type="number" min="0" name="price"  value="{{ $product->price }}"></td>
                </tr>
                <tr>
                    <th>在庫:</th><td><input type="number" min="0" name="stock"  value="{{ $product->stock }}"></td>
                </tr>
            </table>

            <div class="ml-2">
                <button type="submit" class="btn btn-info">更新</button>
            </div>

        </form>

    </div>

</main>
@endsection