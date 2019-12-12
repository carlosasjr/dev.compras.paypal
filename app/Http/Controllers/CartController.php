<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function index()
    {
        $title = "Meu Carrinho de compras";

        $cart = Session::has('cart') ?  Session::get('cart') : new Cart;

        $items = $cart->getItems();

        $total = $cart->total();

        return view('store.cart.index', compact('title', 'items', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home');
        }

        $cart = new Cart();
        $cart->add($product);

        $request->session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function decrement(Request $request, $id) {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home');
        }

        $cart = new Cart();
        $cart->decrementItem($product);

        $request->session()->put('cart', $cart);



        return redirect()->route('cart');


    }
}
