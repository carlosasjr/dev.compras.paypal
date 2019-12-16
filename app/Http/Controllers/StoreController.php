<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $title = 'Home Page Laravel Paypal';

        $products = Product::orderby('id', 'DESC')->get();

        return view('store.home.index', compact('title', 'products'));
    }

    public function orders()
    {
        $title = 'Meus Pedidos:';

        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('store.orders.orders', compact('title', 'orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders');
        }

        //$this->authorize('owner-order', $order);

        if (Gate::denies('owner-order', $order)) {
            return redirect()->back();
        }

        $products = $order->products()->get();

        $title = "Produtos do Pedidos {$id}";

        return view('store.orders.items', compact('order', 'products', 'title'));
    }
}
