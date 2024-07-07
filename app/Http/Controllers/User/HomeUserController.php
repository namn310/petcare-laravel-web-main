<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\product;

class HomeUserController extends Controller
{
    public function index()
    {
        $product=product::select()->where('hot', '=', 1)->get();
        // $imgProduct=$product->getImgProduct()
        return view('User.HomeView', ['product' => $product]);
    }
}
