<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal extends Model
{
    private $apiContext;
    private $identify;
    private $cart;


    public function __construct(Cart $cart)
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'),
                                     config('paypal.secret_id'))
        );

        $this->apiContext->setConfig(config('paypal.settings'));

        $this->identify = bcrypt(uniqid(date('YmdHis')));

        $this->cart = $cart;
    }


    private function payer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        return $payer;
    }

    private function items()
    {
        $items = [];
        $itemsCart = $this->cart->getItems();
        foreach ($itemsCart as $itemCart) {
            $item = new Item();
            $item->setName($itemCart['item']->name)
                ->setCurrency('BRL')
                ->setQuantity($itemCart['qtd'])
                ->setPrice($itemCart['item']->price);

            array_push($items, $item);
        }

        return $items;
    }

    private function itemsList()
    {
        $itemList = new ItemList();
        $itemList->setItems($this->items());

        return $itemList;
    }

    private function details()
    {
        $details = new Details();
        $details->setSubtotal($this->cart->total());

        /* $details->setShipping(1.2) //frete
             ->setTax(1.3) //taxa
             ->setSubtotal(17.50);*/

        return $details;
    }

    private function amount()
    {
        $amount = new Amount();
        $amount->setCurrency("BRL")
            ->setTotal($this->cart->total())  //total liquido se existir taxa e frete
            ->setDetails($this->details());

        return $amount;
    }

    private function transaction()
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->amount())
            ->setItemList($this->itemsList())
            ->setDescription("Compra Licença de Uso SoftProADV")
            ->setInvoiceNumber($this->identify);

        return $transaction;
    }

    private function redirectUrls()
    {
        $baseRoute = route('return.paypal');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("{$baseRoute}/?success=true")
                     ->setCancelUrl("{$baseRoute}/?success=false");

       return $redirectUrls;
    }

    public function generate()
    {
        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($this->payer())
            ->setRedirectUrls($this->redirectUrls())
            ->setTransactions([$this->transaction()]);


        try {
            $payment->create($this->apiContext);

            $paymentID = $payment->getId();

            $approvalUrl = $payment->getApprovalLink();

            return [
                'status'     => true,
                'url_paypal' => $approvalUrl,
                'identify'   => $this->identify,
                'payment_id' => $paymentID
            ];

        } catch (Exception $ex) {
           return [
             'status'    => false,
             'message'   => $ex->getMessage()
           ];
        }



      /*  ResultPrinter::printResult("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment",
            "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);*/

        //return $payment;
    }

    public function execute($paymentId, $token, $PayerID)
    {
       $payment = Payment::get($paymentId, $this->apiContext);

       if ($payment->getState() != 'approved') {
            $execution = new PaymentExecution();
            $execution->setPayerId($PayerID);

            $result = $payment->execute($execution, $this->apiContext);

            return $result->getState();
       }

       return $payment->getState();
    }
}
