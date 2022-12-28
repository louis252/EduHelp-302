<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\School;
use App\Models\ReqList;
use App\Models\Offer;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request){

        if(auth()->user()->role != "Administrator"){
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
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
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
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

    public function add_resource_request(Request $request){
        if(auth()->user()->role != "Administrator"){
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/admin_profile');
            }else{
                return view('/auth/schoolAdmin/request_resource');
            }
        }
    }

    public function add_tutorial_request(Request $request){
        if(auth()->user()->role != "Administrator"){
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/admin_profile');
            }else{
                return view('/auth/schoolAdmin/request_tutorial');
            }
        }
    }

    public function view_request(Request $request){
        $resource_request = ReqList::where([['schoolID', '=', auth()->user()->schoolID], ['requestType', '=', 'Resource']])->paginate(5, ['*'], 'Resource');
        $tutorial_request = ReqList::where([['schoolID', '=', auth()->user()->schoolID], ['requestType', '=', 'Tutorial']])->paginate(5, ['*'], 'Tutorial');

        if(auth()->user()->role != "Administrator"){
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/admin_profile');
            }else{
                return view('/auth/schoolAdmin/request_list', [
                    "resource_request" => $resource_request,
                    "tutorial_request" => $tutorial_request,
                ]);
            }
        }
    }

    public function view_offer(Request $request){
        $request = ReqList::get();
        $offer = Offer::where([['offerStatus', '=', false]])->paginate(5, ['*'], 'offer');
        $offeror = User::where([['role', '=', 'Volunteer']])->get();

        if(auth()->user()->role != "Administrator"){
            return redirect("/");
        }else if(auth()->user()->role === "Volunteer"){
            return redirect('/volunteer_dashboard');
        }else{
            if(auth()->user()->phone === null){
                return redirect('/admin_profile');
            }else{
                return view('/auth/schoolAdmin/offer_list', [
                    "request" => $request,
                    "offeror" => $offeror,
                    "offer" => $offer
                ]);
            }
        }
    }

    public function approve_offer(Request $request)
    {
        Offer::where('offerID', $request->offerID)->update([
            'offerStatus' => true,
        ]);

        ReqList::where('requestID', $request->requestID)->update([
            'requestStatus' => true,
            'offerID' => $request->offerID,
        ]);

        $message = "Offer ID (".$request->offerID.") has been accepted.";

        return redirect()->back()->with('message', $message);;
    }

    public function update (Request $request)
    {
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
