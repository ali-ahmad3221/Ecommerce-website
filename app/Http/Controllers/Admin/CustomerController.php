<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function ourCustomers(){
        $data['customers'] = User::where('type', 'customer')->get();
        return view('admin.pages.customer', $data);
    }

    public function customerStatus(){
        $customer = User::where('id', request()->customer_id)->first();
        if(isset($customer)){
            $customer->status = request()->status;
            $customer->save();
            return redirect()->back()->with('success', 'customer status has been changed successfully!');
        }else{
            return redirect()->back()->with('success', 'incorrect customer infor');
        }
    }
}
