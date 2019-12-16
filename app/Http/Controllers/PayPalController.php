<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PayPal;
use Illuminate\Http\Request;
use Session;

class PayPalController extends Controller
{
    public function __construct()
    {
        $this->middleware('cart-items');
    }

    public function paypal(Order $order)
    {
        $cart = new Cart();

        $paypal = new PayPal($cart);

        $result = $paypal->generate();

        if (!$result['status']) {
            return redirect()->route('cart')->with('message', 'Erro inesperado');
        }

        $paymentID = $result['payment_id'];

        $order->newOrderProducts($cart->total(), $paymentID, $result['identify'], $cart->getItems());


        Session::put('payment_id', $paymentID);

        return redirect()->away($result['url_paypal']);
    }


    public function returnPayPal(Request $request)
    {
        $success = ($request->success == 'true') ? true : false;
        $paymentId = $request->paymentId;
        $token = $request->token;
        $PayerID = $request->PayerID;

        if (!$success) {
            return redirect()->route('cart')->with('message', 'Pedido Cancelado!');
        }


        if(empty($paymentId) || empty($token) || empty($PayerID)) {
            return redirect()->route('cart')->with('message', 'Não autorizado');
        }

        if (!Session::has('payment_id') || Session::has('payment_id') != $paymentId) {
            return redirect()->route('cart')->with('message', 'Não autorizado');
        }


        $cart = new Cart();

        $paypal = new PayPal($cart);
        $response = $paypal->execute($paymentId, $token, $PayerID);

        if ($response == 'approved') {
            $order = new Order();

            $order->changeStatus($paymentId, 'approved');

            $cart->emptyItems();
            Session::forget('payment_id');

            return redirect()->route('home');

        } else {
            return redirect()->route('cart')->with('message', 'Pedido não foi aprovado!');
        }


    }
}
