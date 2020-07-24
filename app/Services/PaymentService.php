<?php

namespace App\Services;

use URL;
use Auth;
use Session;
use Redirect;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Enum\UserType;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use App\Services\UserService;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use App\Services\ProductOrderService;
use Illuminate\Support\Facades\Config;

class PaymentService
{
  public function __construct(ProductOrderService $productOrderService)
  {
    $paypal_conf = Config::get('paypal');
    $this->_api_context = new  ApiContext(
      new OAuthTokenCredential(
        $paypal_conf['client_id'],
        $paypal_conf['secret']
      )
    );

    $this->productOrderService = $productOrderService;
    $this->_api_context->setConfig($paypal_conf['settings']);
  }

  public function payWithPaypal($cart)
  {
    Session::put('package', $cart);
    $paymentAmount = $this->getTotalPrice($cart);
    $payer = $this->getPayer();
    $item = $this->getItem($paymentAmount, "My Order");
    $itemList = $this->getItemList($item);
    $amount = $this->getAmount($paymentAmount);
    $transaction = $this->getTransaction($amount, $itemList, "Order Payment");
    $redirectUrls = $this->getRedirectURL();
    $payment = $this->getPayment($payer, $redirectUrls, $transaction);

    try {
      $payment->create($this->_api_context);

      return $this->completePayment($payment);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
      if (Config::get('app.debug')) {
        Session::flash('error', 'Connection timeout');
        return view('user.' . strtolower(Auth::user()->user_type) . '.dashboard');
      } else {
        Session::flash('error', 'Some error occur, sorry for inconvenient');

        return view('user.' . strtolower(Auth::user()->user_type) . '.dashboard');
      }
    }
  }

  private function getTotalPrice($cart)
  {
    $price = 0;

    foreach ($cart as $id => $details) {
      $price += ($details['price'] - (($details['discount'] / 100) * $details['price'])) * $details['quantity'];
    }

    return $price;
  }

  private function completePayment($payment)
  {
    foreach ($payment->getLinks() as $link) {
      if ($link->getRel() == 'approval_url') {
        $redirectUrl = $link->getHref();
        break;
      }
    }

    Session::put('paypal_payment_id', $payment->getId());

    if (isset($redirectUrl)) {
      // dd($redirectUrl);
      return redirect()->away($redirectUrl);
    }

    Session::flash('error', 'Unknown error occurred');
    return view('product.checkout');;
  }

  private function getPayer()
  {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    return $payer;
  }

  private function getAmount($paymentAmount)
  {
    $amount = new Amount();
    $amount->setCurrency('USD')->setTotal($paymentAmount);

    return $amount;
  }

  private function getItem($paymentAmount, $package)
  {
    $item = new Item();
    $item->setName($package)
      ->setCurrency('USD')
      ->setQuantity(1)
      ->setPrice($paymentAmount);

    return $item;
  }

  private function getItemList($item)
  {
    $itemList = new ItemList();
    $itemList->setItems(array($item));

    return $itemList;
  }

  private function getTransaction($amount, $itemList, $description)
  {
    $transaction = new Transaction();
    $transaction->setAmount($amount)
      ->setItemList($itemList)
      ->setDescription($description);

    return $transaction;
  }

  private function getRedirectURL()
  {
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(URL::to('payment/status'))
      ->setCancelUrl(URL::to('payment/status'));

    return $redirectUrls;
  }

  private function getPayment($payer, $redirectUrl, $transaction)
  {
    $payment = new Payment();
    $payment->setIntent('Sale')
      ->setPayer($payer)
      ->setRedirectUrls($redirectUrl)
      ->setTransactions(array($transaction));

    return $payment;
  }

  public function getPaymentStatus($token, $payerId, $paymentId)
  {
    if (empty($payerId) || empty($token)) {
      Session::flash('error', "Couldn't complete the subscription. Please try again in a while.");
      return redirect("/checkout");
    }

    $result = $this->getPaymentResult($payerId, $paymentId);

    if ($result->getState() == 'approved') {
      Session::flash('success', 'Your subscription is successfully completed.');

      return redirect("/my-orders");
    }

    Session::flash('error', "Couldn't complete the subscription. Please try again in a while.");

    return redirect("/checkout");
  }

  private function getPaymentResult($payerId, $paymentId)
  {
    $payment = Payment::get($paymentId, $this->_api_context);
    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    $cart = session()->get('cart');
    $this->productOrderService->placeOrder($cart, "PayPal");

    return $payment->execute($execution, $this->_api_context);
  }

  private function createSubscription($payment)
  {
    $package = Session::get('package');
    $amount = $payment->transactions[0]->amount->total;
    $this->subscriptionService->create($package, 1, $amount);
    $package = Session::forget('package');
  }
}