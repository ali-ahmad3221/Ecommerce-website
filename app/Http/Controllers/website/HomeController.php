<?php

namespace App\Http\Controllers\website;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['best_products'] = Product::all();
        $data['new_products'] = Product::where('type','new-arrivals')->get();
        $data['hot_products'] = Product::where('type','hot-sales')->get();
        return view('website.pages.home', $data);
    }

    public function cart(){
        return view('website.shopping-cart');
    }

    public function checkOut(){
        return view('website.checkout');
    }

    public function shop(){
        return view('website.pages.shop');
    }

    public function blog(){
        return view('website.pages.blog');
    }

    public function contectUs(){
        return view('website.pages.contact');
    }

}
