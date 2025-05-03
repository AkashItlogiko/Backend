<?php

namespace App\Http\Controllers\Api;

use Stripe\Stripe;
use ErrorException;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class OrderController extends Controller
{
      /**
     * Store new order
     */
   public function store(Request $request)
   {
    foreach ($request->products as $product) {
        $order = Order::create([
            'qty' => $product['qty'],
            'user_id' => $request->user()->id,
            'coupon_id' => $product['coupon_id'],
            'total' => $this->calculateTotal($product['price'],$product['qty'],$product['coupon_id']),
        ]);
        $order->products()->attach($product['product_id']);
    }
    return response()->json([
        'user' => UserResource::make($request->user())
    ]);
   }
     /**
     * Pay order using stripe
     */
   public function payOrderByStripe(Request $request)
   {
    Stripe::setApiKey("YOUR SECRET KEY");
   }
   

}
