<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\School;
use App\Models\ReqList;
use App\Models\Offer;


class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request){

        if(auth()->user()->role != "Volunteer"){
            return redirect("/");;
        }else if(auth()->user()->role === "Administrator"){
            return redirect('/admin_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/volunteer_profile');
            }else{
                return view('/auth/volunteer/index');
            }
        }
    }

    public function profile(Request $request){
        if(auth()->user()->role != "Volunteer"){
            return redirect("/");;
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

    public function view_request(Request $request){
        $resource_request = ReqList::where([['requestStatus', '=', false], ['requestType', '=', 'Resource']])->paginate(5, ['*'], 'Resource');
        $tutorial_request = ReqList::where([['requestStatus', '=', false], ['requestType', '=', 'Tutorial']])->paginate(5, ['*'], 'Tutorial');
        $school = School::get();

        if(auth()->user()->role != "Volunteer"){
            return redirect("/");;
        }else if(auth()->user()->role === "Administrator"){
            return redirect('/admin_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/volunteer_profile');
            }else{
                return view('/auth/volunteer/request_list', [
                    "resource_request" => $resource_request,
                    "tutorial_request" => $tutorial_request,
                    "school" => $school
                ]);
            }
        }
    }

    public function view_offer(Request $request){
        $request = ReqList::get();
        $offer = Offer::where([['username', '=', auth()->user()->username]])->paginate(5, ['*'], 'offer');
        $school = School::get();

        if(auth()->user()->role != "Volunteer"){
            return redirect("/");;
        }else if(auth()->user()->role === "Administrator"){
            return redirect('/admin_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/volunteer_profile');
            }else{
                return view('/auth/volunteer/offer_list', [
                    "request" => $request,
                    "school" => $school,
                    "offer" => $offer
                ]);
            }
        }
    }

}


