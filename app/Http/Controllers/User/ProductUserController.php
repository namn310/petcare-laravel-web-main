<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\DB;
use App\Models\User\productUser;
use App\Models\ImageProduct;
use App\Models\product;
use App\Models\User\Comment;
use Hamcrest\Type\IsNumeric;
use Throwable;

class ProductUserController extends Controller
{
    public function index($id)
    {
        if (is_numeric($id)) {
            $products = product::select()->where('idCat', $id)->get();
            $category = category::all();
            $categoryName = DB::table('categories')->where('idCat', $id)->get();
            return view('User.product', ['products' => $products, 'category' => $category, 'categoryName' => $categoryName]);
        } else {
            $categoryFist = category::first();
            // $product = DB::table('products')->where('idCat', $id)->get();
            $idCatFirst = $categoryFist->idCat;
            $products = product::select()->where('idCat', $idCatFirst)->get();
            foreach ($products as $row) {
                $id = $row->idCat;
            }
            $category = category::all();
            $categoryName = DB::table('categories')->where('idCat', $id)->get();
            return view('User.product', ['products' => $products, 'category' => $category, 'categoryName' => $categoryName]);
        }
    }
    // public function getProductByCategory($id)
    // {
    //     $products = product::select()->where('idCat', $id)->get();
    //     foreach ($products as $row) {
    //         $id = $row->idCat;
    //     }
    //     $category = category::all();
    //     $categoryName = DB::table('categories')->where('idCat', $id)->get();
    //     return view('User.product', ['products' => $products, 'category' => $category, 'categoryName' => $categoryName]);
    // }
    // public function getProduct($id)
    // {
    //     $products = product::select()->where('idCat', $id)->get();
    //     $category = category::all();
    //     $categoryName = DB::table('categories')->where('idCat', $id)->get();
    //     return view('User.product', ['products' => $products, 'category' => $category, 'categoryName' => $categoryName]);
    // }
    public function getDetail($id)
    {
        $comment = Comment::select()->where('idPro', $id)->get();
        $product = new productUser();
        $category = category::all();
        $productDetail = $product->getDetail($id);
        $productMainImg = $product->getImgProduct($id);
        $productListImg = $product->getAllImg($id);
        return view('User.product-detail', ['productDetail' => $productDetail, 'category' => $category, 'productMainImg' => $productMainImg, 'productListImg' => $productListImg, 'comment' => $comment]);
    }

    public function Product(Request $request)
    {
        $sortField = $request->input('sort_field');
        $sortOrder = $request->input('sort_order');
        $idCat = $request->input('catId');
        // $product = DB::table('products')->select()->join('image_products', 'products.idPro', '=', 'image_products.idPro')->where('idCat', $idCat)->groupBy('image_products.idPro')->orderBy($sortField, $sortOrder)->get();
        // dd($Pro);
        $productList = product::select()->where('idCat', $idCat)->orderBy($sortField, $sortOrder)->get();
        $product = [];
        foreach ($productList as $a) {
            $productItem = [
                'namePro' => $a->namePro,
                'cost' => number_format($a->cost),
                'discount' => $a->discount,
                'costDiscount' => number_format($a->cost - ($a->cost * $a->discount) / 100),
                'image' => $a->getImgProduct($a->idPro)
            ];
            $product[] = $productItem;
        }
        return response()->json($product);

        // return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
