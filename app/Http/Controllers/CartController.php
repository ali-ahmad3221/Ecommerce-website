<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addcart(Request $request){
        try {
            if(!is_null(auth()->user())){
                $item = new Cart();
                $item->product_id = $request->product_id;
                $item->qty = $request->product_id;
                $item->customer_id = auth()->user()->id;
                $item->save();
                return redirect()->route('home.page')->with('success', 'your item is added to cart successfully!');
            }else{
                return redirect()->route('login.page')->with('error', 'please login here for add to cart');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cartList(Request $request){
        try {
            if(!is_null(auth()->user())){
                $carts = DB::table('carts')
                ->select('carts.id as id', 'carts.product_id as product_id', 'carts.customer_id as customer_id',
                        'carts.qty', 'products.title', 'products.price')
                ->join('products', 'carts.product_id','products.id')
                ->where('customer_id', auth()->user()->id)
                ->get();

                if(isset($carts)){
                    return view('website.pages.shopping-cart', compact('carts'));
                }else {
                    return redirect()->back()->with('error', 'No item found into cart');
                }
            }else {
                return redirect()->route('login.page')->with('error', 'Please login your account');
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function trashCartItem(Request $request){
        $cart_item = Cart::where('id', $request->cart_id)->first();
        if(isset($cart_item)){
            $cart_item->delete();
            return redirect()->back()->with('success', 'cart item deleted successfully!');
        }else{
            return redirect()->back()->with('error', 'cart item not found!');
        }
    }

    public function updateCartItem(Request $request){
        $cart_item = Cart::where('id', $request->cart_id)->first();
        if(isset($cart_item)){
            $cart_item->qty = $request->qty;
            $cart_item->save();
            return redirect()->back()->with('success', 'cart item updated successfully!');
        }else{
            return redirect()->back()->with('error', 'cart item not found!');
        }
    }

    public function proceedToPayment(){
        try {
            DB::beginTransaction();
            $order =new  Order();
            $order->customer_id = auth()->user()->id;
            $order->bill = request()->total_price;
            $order->address = request()->address;
            $order->name = request()->name;
            $order->phone = request()->number;
            $order->status = 'pending';
            if($order->save()){
                // $carts = Cart::where('customer_id', auth()->user()->id)->get();
                $carts = Cart::with('product')->where('customer_id', auth()->user()->id)->get();
                 // Prepare order items for bulk insert
                $orderItems = $carts->map(function($cart) use ($order) {
                    return [
                        'product_id' => $cart->product_id,
                        'order_id' => $order->id,
                        'qty' => $cart->qty,
                        'price' => $cart->product->price,
                    ];
                })->toArray();
                OrderItem::insert($orderItems);
                Cart::where('customer_id', $user->id)->delete();
                // foreach($carts as $cart){
                //     $product = Product::where('id', $cart->product_id)->first();
                //     $order_item =new  OrderItem();
                //     $order_item->product_id = $cart->product_id;
                //     $order_item->order_id = $order->id;
                //     $order_item->qty = $cart->qty;
                //     $order_item->price = $product->price;
                //     $order_item->save();
                //     $cart->delete();
                // }
            }
            DB::commit();
            return redirect()->route('home.page')->with('success', 'your order has been placed!');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function myOrders(Request $request){
        $orders = Order::where('customer_id', auth()->user()->id)->get();
        if(isset($orders)){
            $data['orders'] = $orders;
            return view('website.pages.my-orders', $data);
        }else{

        }
    }
}
