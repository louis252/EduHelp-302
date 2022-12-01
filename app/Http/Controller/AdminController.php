<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\School;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request){

        if(auth()->user()->role != "Administrator"){
            return view('index');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/admin_profile');
            }else{
                return view('/auth/schoolAdmin/index');
            }
        }
    }

    public function profile(Request $request){
        if(auth()->user()->role != "Administrator"){
            return view('index');
        }else{
            $data = DB::table('schools')->get();
            if(auth()->user()->schoolID === null){
                return view('/auth/schoolAdmin/profile', [
                    "schools" => $data,
                ]);
            }else{
                $data = School::where('id', auth()->user()->schoolID)->first();
                return view('/auth/schoolAdmin/profile', [
                    "schools" => $data,
                    "schoolName" => $data->schoolName,
                    "schoolAddress" => $data->address,
                    "schoolCity" => $data->city,
                ]);
            }
            
        }
    }

    public function update (Request $request){
        $request->validate([
            'phone' => ['required'],
            'staffID' => ['required', 'string', 'max:10'],
            'position' => ['required', 'string', 'max:25'],
        ]);

        $phone = (int)$request->phone;

        User::where('id', auth()->user()->id)->update([
            'phone' => $phone,
            'staffID' => $request->staffID,
            'position' => $request->position,
            'schoolID' => $request->schoolID,
        ]);

        return back()->withSuccess('Your profile has been updated successfully');
    }

}
