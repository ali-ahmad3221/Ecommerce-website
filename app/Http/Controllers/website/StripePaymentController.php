<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        $data['token'] = request()->input('_token');
        $data['name'] = request()->input('name');
        $data['number'] = request()->input('number');
        $data['address'] = request()->input('address');
        $data['total_price'] = request()->input('total_price');
        return view('website.pages.stripe', $data);
    }


    public function stripePost(Request $request)
    {
        // dd(request()->all());
        try {
            DB::beginTransaction();
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => request()->total_price * 100,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Test payment from viltco."
            ]);

            $order =new  Order();
            $order->customer_id = auth()->user()->id;
            $order->bill = request()->total_price;
            $order->address = request()->address;
            $order->name = request()->name;
            $order->phone = request()->number;
            $order->status = 'paid';
            if($order->save()){
                $carts = Cart::with('product')->where('customer_id', auth()->user()->id)->get();
                $orderItems = $carts->map(function($cart) use ($order) {
                    return [
                        'product_id' => $cart->product_id,
                        'order_id' => $order->id,
                        'qty' => $cart->qty,
                        'price' => $cart->product->price,
                    ];
                })->toArray();
                OrderItem::insert($orderItems);
                Cart::where('customer_id', auth()->user()->id)->delete();
            }
            Session::flash('success', 'order completed successful!');
            DB::commit();
            return redirect()->route('cart.list');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

}
