@extends('layouts.app')

@section('content')
<main class="main">
    <div class="link">
        <a href="{{ route('shops.index') }}">ショップ一覧へ</a>
    </div>

    <div class="link">
        <a href="{{ route('lists.index') }}">あなたのショップ一覧へ</a>
    </div>

    <div style="margin-top: 30px">
        <h4>ショップを追加する</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table w-50">
                <tr>
                    <th>ショップ名:</th><td><input type="text" name="name" class="input_form" placeholder="ショップ名"></td>
                </tr>
                <tr>
                    <th>ショップ詳細:</th><td><textarea style="height:150px" name="description" class="input_form" placeholder="ショップ詳細"></textarea></td>
                </tr>
                <tr>
                    <th>画像:</th><td><input id="image" type="file" name="image"></td>
                </tr>
            </table>

            <div class="ml-2">
                <button type="submit" class="btn btn-info">追加</button>
            </div>
        </form>
    </div>

</main>
@endsection