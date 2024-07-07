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

class ProductUserController extends Controller
{
    public function index($id)
    {
        $product = product::select()->where('idCat', $id)->get();
        // $product = DB::table('products')->where('idCat', $id)->get();
        $category = category::all();
        $categoryName = DB::table('categories')->where('idCat', $id)->get();
        return view('User.product', ['product' => $product, 'category' => $category, 'categoryName' => $categoryName]);
    }

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
}
