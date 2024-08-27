<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function ordersList(){
        $data['orders'] = DB::table('users')
            ->join('orders', 'orders.customer_id', 'users.id')
            ->select('orders.*', 'users.status as user_status', 'users.name', 'users.email')
            ->get();
        return view('admin.pages.orders', $data);
    }

    public function getOrderDetails($id){
            $orderitems = DB::table('order_items')
                ->select('products.title', 'products.picture', 'order_items.*')
                ->join('products', 'order_items.product_id', 'products.id')
                ->where('order_id', $id)->get();

            return response()->json([
                'orderDetails'=>$orderitems,
                'status'=>'success',
                'code'=>200
            ]);
    }

    public function orderStatus(){

        $order = Order::where('id', request()->order_id)->first();
        if(isset($order)){
            $order->status = request()->order_status;
            $order->save();
            return redirect()->back()->with('success', 'customer status has been changed successfully!');
        }else{
            return redirect()->back()->with('success', 'incorrect customer infor');
        }
    }
}
