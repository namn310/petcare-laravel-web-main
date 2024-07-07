<?php

namespace App\Http\Controllers;

use App\Models\home;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Booking;
use App\Models\User\Customer;
use App\Models\User\Order;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CustomerTotal = Customer::all()->count();
        $productTotal = product::all()->count();
        $productOutTotal = product::select('idPro')->where('count', '<=', 0)->get()->count();
        $orderTotal = Order::all()->count();
        return view('Admin.HomeAdmin', ['orderTotal' => $orderTotal, 'productTotal' => $productTotal, 'CustomerTotal' => $CustomerTotal, 'productOutTotal' => $productOutTotal]);
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
