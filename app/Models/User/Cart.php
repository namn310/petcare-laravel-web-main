<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class Cart extends Model
{
    private $cart = [];


    use HasFactory;

    public function __construct()
    {
        $this->cart = session('cart') ? session('cart') : [];
    }
    public function listCart()
    {
        return $this->cart;
    }
    public function cartAdd($id)
    {
        $product = product::find($id);
        // if (session('cart')["idPro"] = $id) {
        // session('cart')['count']++;
        // } else {
        $cart = [
            'idPro' => $product->idPro,
            'name' => $product->namePro,
            'cost' => $product->cost,
            'image' => $product->getImgProduct($id),
            'discount' => $product->discount,
            'count' => 1
        ];
        $this->cart[$product->idPro] = $cart;
        session(['cart' => $this->cart]);
    }
    // }  $total += $cart['count'] * ($cart['cost'] - ($cart['cost'] * $cart['discount']) / 100);
    public function CartTotal()
    {
        $total = 0;
        if (session('cart')) {
            foreach (session('cart') as $cart) {
                if ($cart['discount'] !== null) {
                    $total += $cart['count'] * ($cart['cost'] - ($cart['cost'] * $cart['discount']) / 100);
                } else $total += $cart['count'] * $cart['cost'];
            }
        }
        return $total;
    }
    public function countCart()
    {
        $total = 0;
        if (session('cart')) {
            foreach (session('cart') as $row) {
                $total += 1;
            }
        }
        return $total;
    }
    public function updateCart($id, $count)
    {
        $product = product::find($id);
        $cart = [
            'idPro' => $id,
            'name' => $product->namePro,
            'cost' => $product->cost,
            'image' => $product->getImgProduct($id),
            'discount' => $product->discount,
            'count' => $count
        ];
        $this->cart[$id] = $cart;
        session()->put(['cart' => $this->cart]);

        /*
        $product = product::find($id);
        $this->idPro = $id;
        $this->name = $product->namePro;
        $this->cost = $product->cost;
        $this->image = $product->image;
        $this->discount = $product->discount;
        $this->count = $count;
       */
    }
   
}
