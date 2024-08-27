<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\testing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function login(){
        return view('website.pages.login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
           'email' => $request['email'],
           'password' => $request['password'],
           'status' => 'active',
           'type' => 'customer'
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login successfully!');
        } else {
            return redirect()->back()->with('success', 'incorrect info!');
        }
    }

    public function register(){
        return view('website.pages.register');
    }

    public function registration(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if($request->has('file')){
            $user->picture = $request->file('file')->getClientOriginalName();
            $request->file('file')->move('uploads/profiles/', $user->picture);
        }
        $user->type = 'customer';
        $user->save();
        return redirect()->route('login.page')->with('success', 'Register Successfully!');
    }

    public function logOut(Request $request){

        $token = $request->user()->token;
        if ($token) {
            // Revoke the token using Google API
            $client = new Client();
            $client->revokeToken($token);
        }
        Auth::logout();
        if(!auth()->user()){
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            \Cookie::forget('google_token');
            // return redirect('https://accounts.google.com/logout')->with('success', 'You have been logged out.');
            return redirect()->route('login.page');
        } else {
            return redirect()->back();
        }
    }

    public function getProfile(Request $request){
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('website.pages.profile', $data);
    }

    public function updateProfile(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        if(isset($user)){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            if($request->has('file')){
                $user->picture = $request->file('file')->getClientOriginalName();
                $request->file('file')->move('uploads/profiles/', $user->picture);
            }
            $user->type = 'customer';
            $user->save();
            return redirect()->back()->with('success', 'Register Successfully!');
        }
        else {
            return redirect()->back()->with('success', 'Something went wrong!');
        }
    }

    public function testingMail(){

        $details = [
            'title'=> 'This is testing Mail',
            'message'=> 'Hellow dear its a testing mail message',
        ];

        Mail::to('hafizaliahmad4345450@gmail.com')->send(new testing($details));
        return redirect()->route('home.page')->with('success', 'Email sending successfully!');
    }


    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        // dd(Socialite::driver('google'));
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('google')->user();
            // find user in the database where the social id is the same with the id provided by Google
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in
                Auth::login($finduser);

                // redirect user to dashboard page
                return redirect('/');
            }
            else
            {
                // if user not found then this is the first time he/she try to login with Google account
                // create user data with their Google account data
                // $picture = $user->avatar ?? 'path_to_default_random_image.jpg';
                // dd($picture);
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',  // the social login is using google
                    'password' => bcrypt('my-google'),  // fill password by whatever pattern you choose
                    // 'picture' => $user->avatar ?? 'path_to_default_random_image.jpg',
                ]);

                Auth::login($newUser);

                return redirect('/');
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }

}
