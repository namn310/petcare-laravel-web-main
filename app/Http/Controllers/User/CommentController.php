<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Comment;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        if (Auth::guard('customer')->check()) {
            $idCus = Auth::guard('customer')->user()->id;
            $comment = Comment::create([
                'title' => $request->input('comment'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'idCus' => $idCus,
                'idPro' => $id

            ]);
            return redirect("product/detail/" . $id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($idPro, $idCus)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
