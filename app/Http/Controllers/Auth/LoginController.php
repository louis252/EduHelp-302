<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function redirectTo()
    {
        if (Auth::user()->role == "Administrator"){
            return '/admin_dashboard';
        }else{
            return '/volunteer_dashboard';
        }
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     if($user->role == "Administrator"){
    //         return redirect()->route('about');
    //     }else{
    //         return redirect()->route('home');
    //     }
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::AdminDashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
