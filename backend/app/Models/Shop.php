<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // ユーザーとの紐付け
    public function user()
        {
            return $this->belongsTo('App\Models\User');
        }
    
    // 商品との紐付け
    public function product()
        {
            return $this->hasMany('App\Models\Product');
        }
}
