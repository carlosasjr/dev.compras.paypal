<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = [
     'user_id',
     'total',
     'status',
     'payment_id',
     'identify'
   ];


   public function products()
   {
       return $this->belongsToMany(Product::class, 'order_product')
                   ->withPivot('quantity', 'price');
   }


   public function newOrderProducts($totalCart, $paymentID, $identify, $itemsCart)
   {
       $order = $this->create([
           'user_id'       => auth()->user()->id,
           'total'         => $totalCart ,
           'status'        => 'started',
           'payment_id'    => $paymentID,
           'identify'      => $identify,
       ]);

       $productsOrder = [];
       $items = $itemsCart;

       foreach ($items as $item) {
           $idProduct = $item['item']->id;

           $productsOrder[$idProduct] = [
               'quantity'  => $item['qtd'],
               'price'     => $item['item']->price
           ];
       }

       $order->products()->attach($productsOrder);
   }

   public function changeStatus($paymentId, $status) {
       $this->where('payment_id', $paymentId)->update(['status' => $status]);
   }
}
