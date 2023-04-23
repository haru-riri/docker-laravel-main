<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        // user情報を取得 
        $id = Auth::id();
        $shops = Shop::all();
       
        return view('lists.index', compact('id', 'shops'));
    }
}
