<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Cart extends Model
{
    private $items = array();

    public function __construct()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $this->items = $cart->items;
        }
    }

    public function add(Product $product)
    {
        if (isset($this->items[$product->id])) {
            $this->items[$product->id] = [
                'item' => $product,
                'qtd' => $this->items[$product->id]['qtd'] + 1
            ];
        } else {
            $this->items[$product->id] = [
                'item' => $product,
                'qtd' => 1
            ];
        }
    }

    public function decrementItem(Product $product)
    {
        if (isset($this->items[$product->id])) {

            if ($this->items[$product->id]['qtd'] == 1) {
                unset($this->items[$product->id]);
            } else {
                $this->items[$product->id] = [
                    'item' => $product,
                    'qtd' => $this->items[$product->id]['qtd'] - 1
                ];
            }

        }
    }

    public function getItems()
    {
        return $this->items;
    }

    public function total()
    {
        $total = 0;

        if (count($this->items) == 0)
            return $total;



        foreach ($this->items as $item) {
            $subtotal = $item['item']->price * $item['qtd'];
            $total += $subtotal;
        }

        return $total;
    }

    public function totalItems()
    {
        return count($this->items);
    }

    public function emptyItems() {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
    }
}
