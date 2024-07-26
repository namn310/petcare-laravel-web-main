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
    public function store(Request $request, $id)
    {
        if (Auth::guard('customer')->check()) {
            $idCus = Auth::guard('customer')->user()->id;
            $comment = Comment::create([
                'title' => $request->input('commentTitle'),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'idCus' => $idCus,
                'idPro' => $id

            ]);
            return redirect("product/detail/" . $id);
        }
    }

   
}
