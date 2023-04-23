<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvController extends Controller
{
    public function download(Product $product, Request $request, $value)
    {

        $cvsList = [];

        // $valueはURLから受け取った商品番号
        // すべての商品を取得
        $products = Product::all();
        // 1つずつ商品を取り出す
        foreach($products as $product){
            // 商品番号($value)と$productのidが同じだったら商品情報を配列に入れる
            if($value == $product->id){
                $cvsList = [
                    ['id' => '商品名','value' => $product->name],
                    ['id' => '説明', 'value' => $product->description],
                    ['id' => '価格', 'value' => $product->price],
                    ['id' => '在庫', 'value' => $product->stock]
                ];
            }
        }

        $response = new StreamedResponse (function() use ($request, $cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="商品情報.csv"');
 
        return $response;
    }
}


