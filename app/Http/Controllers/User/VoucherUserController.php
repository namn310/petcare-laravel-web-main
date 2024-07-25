<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\VoucherUser;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Support\Facades\Auth;

class VoucherUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {

        $idCus = Auth::guard('customer')->user()->id;
        $VoucherUser = new VoucherUser();
        try {
            $VoucherUser->saveVoucher($id, $idCus);
        } catch (Throwable) {
            return redirect(route('user.home'))->with('error', 'Có lỗi vui lòng thử lại sau');
        }
        return redirect(route('user.home'))->with('success', 'Lưu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
