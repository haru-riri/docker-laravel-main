@extends('layouts.app')

@section('content')
<main class="main">
    <div class="link">
        <a href="{{ route('shops.index') }}">ショップ一覧へ</a>
    </div>

    <div class="link">
        <a href="{{ route('shops.create') }}">新しいショップを登録する</a>
    </div>

    <div class="row">
        <div class="card-deck" style="width: 100%;">
        @foreach ($shops as $shop)
            @if($id === ($shop->admin_id))
                <div class="col-lg-4 mt-3 mb-3">
                    <div class="card" style="height: 500px">
                        <div>
                            <img src="{{ Storage::url($shop->image)}}" class="card-img card-img-top" style="height:250px;  object-fit: cover;">
                            </div>
                        <div class="card-body">
                            <h5 class="card-title">店舗名:{{$shop->name}}</h5>
                            
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item pl-0 pt-1 border-0">店舗説明:{{$shop->description}}</li>
                                </ul>
                            <form action="{{ route('shops.destroy',$shop->id) }}" method="POST">
                                <div>
                                    <a href="{{ route('shops.show',$shop->id) }}">店舗詳細へ</a>
                                </div>
                                <div>
                                    <a href="{{ route('shops.edit',$shop->id) }}">店舗編集へ</a>
                                </div>
                                
                                @csrf
                                @method('DELETE')
                                <div>
                                    <button class="btn btn-primary mt-2" type="submit">店舗削除</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</main>
@endsection