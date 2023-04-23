@extends('layouts.app')

@section('content')
<main class="main">

    {{-- オーナー用メニュー --}}
    <div class="mb-3">
        @can('owner')
        <div class="mt-4 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mb-2 mb-2 bi bi-brush" viewBox="0 0 16 16">
                <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04zM4.705 11.912a1.23 1.23 0 0 0-.419-.1c-.246-.013-.573.05-.879.479-.197.275-.355.532-.5.777l-.105.177c-.106.181-.213.362-.32.528a3.39 3.39 0 0 1-.76.861c.69.112 1.736.111 2.657-.12.559-.139.843-.569.993-1.06a3.122 3.122 0 0 0 .126-.75l-.793-.792zm1.44.026c.12-.04.277-.1.458-.183a5.068 5.068 0 0 0 1.535-1.1c1.9-1.996 4.412-5.57 6.052-8.631-2.59 1.927-5.566 4.66-7.302 6.792-.442.543-.795 1.243-1.042 1.826-.121.288-.214.54-.275.72v.001l.575.575zm-4.973 3.04.007-.005a.031.031 0 0 1-.007.004zm3.582-3.043.002.001h-.002z"/>
            </svg>
            <h3 class="d-inline">オーナー用メニュー</h3>
        </div>

        <div class="link">
            <a href="{{ route('shops.create') }}">新しいショップを登録する</a>
        </div>
        <div class="link">
            <a href="{{ route('lists.index') }}">あなたのショップ一覧</a>
        </div>
        @endcan
    </div>

    {{-- ショップメニュー --}}
    <div class="mt-2">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="mb-3 mr-2 bi bi-shop" viewBox="0 0 16 16">
            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/></svg>
            <h3 class="d-inline">ショップ一覧</h3>
        </div>

        <div class="row">
            <div class="card-deck" style="width: 100%;">
                @foreach ($shops as $shop)
                    <div class="col-md-3 mt-2 mb-3">
                        <div class="card" style="height:380px">
                            <a href="{{ route('shops.show',$shop->id) }}">
                                <img src="{{ Storage::url($shop->image)}}" class="card-img card-img-top" style="height:250px;  object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $shop->name }}</h5>
                                <p class="card-text text-truncate">{{ $shop->description }}</p>
                                <a href="{{ route('shops.show',$shop->id) }}">店舗詳細へ</a>   
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</main>
 @endsection
