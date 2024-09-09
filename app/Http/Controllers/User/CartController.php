<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\User\Cart;
use App\Models\product;
use Illuminate\Support\Facades\Session;
use Throwable;
use App\Models\User\VoucherUser;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use App\Models\User\Order;
use App\Models\User\OrderDetail;
use Error;

class CartController extends Controller
{

    public function index(Cart $cart)
    {
        $idCus = (Auth::guard('customer')->check()) ? Auth::guard('customer')->user()->id : 0;
        $voucherDetail = new Voucher();
        $voucher = VoucherUser::select()->where('id_Cus', $idCus)->where('soluong', '>', 0)->get();
        //dd(session('cart'));
        $cartCount = $cart->countCart();
        $cartItem = $cart->listCart();
        $cartTotal = $cart->CartTotal();
        return view('User.cart', ['cartItem' => $cartItem, 'cartTotal' => $cartTotal, 'cartCount' => $cartCount, 'voucher' => $voucher, 'voucherDetail' => $voucherDetail]);
    }
    public function add($id, Cart $cart)
    {
        $product = product::find($id);
        //xóa session
        //session()->forget('cart');
        $cart->cartAdd($id);
        return redirect(route('user.cart'));
    }
    public function destroyCart()
    {
        session()->forget('cart');
        return redirect(route('user.cart'))->with('status', 'Xóa giỏ hàng thành công !');
    }
    public function update(Request $request, Cart $cart)
    {
        foreach (session('cart') as $cartItem) {
            $id = $cartItem['idPro'];
            $count = $request->input('idPro' . $id);
            $cart->updateCart($id, $count);
        }

        return redirect(route('user.cart'))->with('status', 'Cập nhật thành công !');
    }
    public function delete($id)
    {
        try {
            $cart = session('cart');
            unset($cart[$id]);
            session(['cart' => $cart]);
        } catch (Throwable) {
            return redirect(route('user.cart'))->with('error', 'Xóa sản phẩm thất bại !');
        }
        return redirect(route('user.cart'))->with('status', 'Xóa sản phẩm thành công !');
    }
    public function checkout(Cart $cart)
    {
        $cartCount = $cart->countCart();
        $cartItem = $cart->listCart();
        $cartTotal = $cart->CartTotal();
        return view('User.CheckOut', ['cartItem' => $cartItem, 'cartTotal' => $cartTotal, 'cartCount' => $cartCount]);
    }
    public function useVoucher(Request $request)
    {
        //id voucher user
        $VoucherUser = $request->input('idVoucherUser');
        $voucher = VoucherUser::find($VoucherUser);
        // lấy idVoucher trong bảng voucher_users để lấy dữ liệu trong bảng vouchers
        $voucherDetail = Voucher::find($voucher->id_voucher);
        $voucherDetailId = $voucherDetail->id;
        // lấy giảm giá của vouchers
        $discount = $voucherDetail->discount;
        // lấy điều kiện số lượng của voucher
        $dk_soluong = $voucherDetail->dk_soluong;
        // lấy điều kiện hóa đơn của voucher
        $dk_hoadon = $voucherDetail->dk_hoadon;
        $cart = new Cart();
        $cartTotal = $cart->CartTotal();
        $cartCount = $cart->countCart();
        $costWithDiscount = $cartTotal - ($cartTotal * ($discount / 100));
        // format discount
        $discountFormat = $discount . '%';
        // format tổng tiền
        $costFormat = number_format($costWithDiscount) . 'đ';
        $cost = ['cost' => number_format($costWithDiscount), 'discount' => $discount, 'discountFormat' => $discountFormat, 'costFormat' => $costFormat, 'idVoucher' => $VoucherUser];
        //check đơn hàng xem có thỏa mãn điều kiện dùng voucher không
        $error = ['error' => 'Đơn hàng không đủ điều kiện để dùng voucher'];
        if ($cartTotal >= $dk_hoadon && $cartCount >= $dk_soluong) {
            return response()->json($cost);
        } else {
            return response()->json($error);
        }
    }
    public function confirmCheckOut(Request $request)
    {

        $cart = new Cart();
        try {
            if (session()->has('userGoogle')) {
                $idCus = session('userGoogle.user_google_id');
            } else {
                $idCus = Auth::guard('customer')->user()->id;
            }
            $cart->checkOut($request, $idCus);
        } catch (Throwable $Error) {
            dd($Error);
            // return redirect(route('user.cart'))->with('error', 'Có lỗi xin vui lòng thử lại sau !');
        }
        session()->forget('cart');
        return redirect(route('user.cart'))->with('status', 'Đơn hàng của bạn đã được xác nhận !');
    }
}
