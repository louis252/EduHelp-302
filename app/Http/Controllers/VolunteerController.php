<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\School;


class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request){

        if(auth()->user()->role != "Volunteer"){
            return view('index');
        }else if(auth()->user()->role === "Administrator"){
            return redirect('/admin_dashboard');
        }   
        else{
            if(auth()->user()->phone === null){
                return redirect('/volunteer_profile');
            }else{
                return view('/auth/volunteer/index');
            }
        }
    }

    public function profile(Request $request){
        if(auth()->user()->role != "Volunteer"){
            return view('index');
        }else{
            return view('/auth/volunteer/profile');
        }
    }

    public function update (Request $request){
        $request->validate([
            'phone' => ['required'],
            'date' => ['required', 'date'],
            'occupation' => ['required', 'string', 'max:30'],
        ]);

        $phone = (int)$request->phone;
        $dateformat = date('Y-m-d', strtotime($request->date));

        User::where('id', auth()->user()->id)->update([
            'phone' => $phone,
            'dateOfBirth' => $dateformat,
            'occupation' => $request->occupation,
        ]);

        return back()->withSuccess('Your profile has been updated successfully');
    }

}
