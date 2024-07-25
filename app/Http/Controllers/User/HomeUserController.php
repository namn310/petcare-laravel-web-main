<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\Voucher;
use App\Models\User\VoucherUser;

class HomeUserController extends Controller
{
    public function index()
    {
        $voucherDetail = new VoucherUser();
        $voucher = Voucher::all()->where('status', '=', 1);
        $product = product::select()->where('hot', '=', 1)->get();
        // $imgProduct=$product->getImgProduct()
        return view('User.HomeView', ['product' => $product, 'voucher' => $voucher, 'voucherDetail' => $voucherDetail]);
    }
}
