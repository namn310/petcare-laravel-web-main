<?php

namespace App\Http\Controllers;

use App\Models\home;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Booking;
use App\Models\User\Customer;
use App\Models\User\Order;
use App\Models\Discount;
use App\Models\Voucher;
use App\Models\User\OrderDetail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //update status discount
        $discount = new Discount();
        $discount->updateStatusDiscount();
        $discount->updateDiscountProduct();
        //update status voucher
        $voucher = new Voucher();
        $voucher->updateStatusVoucher();
        $CustomerTotal = Customer::all()->count();
        $productTotal = product::all()->count();
        $productOutTotal = product::select('idPro')->where('count', '<=', 0)->get()->count();
        $orderTotal = Order::where('created_at', '<', now('Asia/Ho_Chi_Minh'))->count();
        //tổng tiền
        $Cost = 0;
        $cost = OrderDetail::where('created_at', '<', now('Asia/Ho_Chi_Minh'))->select('number', 'price')->get();
        foreach ($cost as $row) {
            $Cost += $row->number * $row->price;
        }
        // đơn hàng
        $orderDetail = Order::orderBy('id', 'desc')->limit(5)->get();
        $order = new Order();
        // product
        $product = product::orderBy('idPro', 'desc')->where('hot', '=', '1')->limit(10)->get();
        $productImg = new product();
        //Thông báo
        $OrderNotice = Order::all();
        $CustomerNotice = Customer::all();
        return view('Admin.HomeAdmin', ['orderTotal' => $orderTotal, 'productTotal' => $productTotal, 'CustomerTotal' => $CustomerTotal, 'productOutTotal' => $productOutTotal, 'Cost' => $Cost, 'orderDetail' => $orderDetail, 'order' => $order, 'product' => $product, 'productImg' => $productImg, 'OrderNotice' => $OrderNotice, 'CustomerNotice' => $CustomerNotice]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(home $home)
    {
        //
    }
}
