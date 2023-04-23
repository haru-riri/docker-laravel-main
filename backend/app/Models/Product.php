<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // ショップモデルとの紐付け
    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }
}
