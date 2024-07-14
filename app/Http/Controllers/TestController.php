<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $product = product::select()->where('products.idCat', 1)->orderBy('cost', 'desc')->get();
        // $product = product::select('cost')->orderBy('cost', 'asc')->get();
        // dd($Pro);
        // $product = DB::table('products')->select('namePro')->where('idCat', 1)->get();
        $productlist = [];
        foreach ($product as $a) {
            $productItem = [
                'namePro' => $a->namePro,
                'cost' => $a->cost,
                'discount' => $a->discount,
                'costDiscount' => number_format($a->cost - ($a->cost * $a->discount) / 100),
                'image' => $a->getImgProduct($a->idPro)
            ];
            $productlist[] = $productItem;
        }

        dd(response()->json($productlist));
        return response()->json($productlist);

        return response()->json(['error' => 'Internal Server Error'], 500);
    }
    public function store(Request $request)
    {
        //  dd($request->all());
        $image = $request->file('image');
        $count = 0;
        foreach ($image as $img) {
            $count++;
            $ex = $img->getClientOriginalExtension();
            $filename = time() . ' ' . $count . $ex;
            print($filename);
        }
    }
}
