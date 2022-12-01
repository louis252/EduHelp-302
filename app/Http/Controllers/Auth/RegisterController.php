<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // protected function authenticated(Request $request, $user)
    // {
    //     if($user->role === "Administrator"){
    //         return redirect('admin_dashboard');
    //     }else{
    //         return redirect('volunteer_dashboard');
    //     }
    // }

    protected function redirectTo()
    {
        if (Auth::user()->role == "Administrator"){
            return '/admin_dashboard';
        }else{
            return '/volunteer_dashboard';
        }
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::AdminDashboard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    } 

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:25'],
            'password' => ['required', 'string', 'min:8', 'max:25', 'same:confirmpassword'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $fullName = $data['firstName'] . " " . $data['lastName'];
        $role = "";
        if($data['radio'] == "administrator"){
            $role = "Administrator";
        }else if($data['radio'] == "volunteer"){
            $role = "Volunteer";
        };
        
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'fullName' => $fullName,
            'email' => $data['email'],
            'role' => $role,
        ]);
    }
}
