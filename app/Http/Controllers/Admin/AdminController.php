<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function login(){
        return view('admin.pages.login');
    }

    public function loginAdmin(Request $request){
        $credentials = [
           'email' => $request['email'],
           'password' => $request['password'],
           'type' => 'admin'
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.view')->with('success', 'Login successfully!');
        } else {
            return redirect()->back()->with('success', 'incorrect info!');
        }
    }

    public function register(){
        return view('admin.pages.register');
    }

    public function adminRegister(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if($request->has('file')){

            $user->picture = $request->file('file')->getClientOriginalName();
            $request->file('file')->move('uploads/profiles/', $user->picture);
        }
        $user->type = 'admin';
        $user->save();
        return redirect()->route('admin.login')->with('success', 'Register Successfully!');
    }

    public function adminDashboard(){
        return view('admin.index');
    }

    public function logOut(Request $request){
        Auth::logout();
        if(!auth()->user()){
            return redirect()->route('admin.login');
        } else {
            return redirect()->back();
        }
    }

    public function profile(){
        if(!is_null(auth()->user())){
            $user = User::where('id','=',auth()->user()->id)->first();
            $data['user'] = $user;
            return view('admin.pages.profile', $data);
        }else {
            return redirect()->back()->with('success', 'Your are not login Now!');
        }
    }
}
