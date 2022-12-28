<?php

namespace App\Http\Controllers;

use App\Models\ReqList;
use App\Http\Requests\StoreReqListRequest;
use App\Http\Requests\UpdateReqListRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReqListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function rstore(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'resourceType' => ['required', 'string'],
            'numRequired' => ['required', 'integer'],
        ]);

        $reqlist = new ReqList;

        $reqlist->requestDate = date('Y-m-d');
        $reqlist->requestStatus = false;
        $reqlist->description = $request->description;
        $reqlist->requestType = "Resource";
        $reqlist->resourceType = $request->resourceType;
        $reqlist->numRequired = $request->numRequired;
        $reqlist->schoolID = auth()->user()->schoolID;

        $reqlist->save();

        return redirect()->back()->with('message', 'A new resource request has been successfuly created.');
    }

    public function tstore(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'proposedDate' => ['required', 'date'],
            'proposedTime' => ['required', 'string'],
            'studentLevel' => ['required', 'integer'],
            'numStudent' => ['required', 'integer'],
        ]);

        $reqlist = new ReqList;
        
        $reqlist->requestDate = date('Y-m-d');
        $reqlist->requestStatus = false;
        $reqlist->description = $request->description;
        $reqlist->requestType = "Tutorial";
        $reqlist->proposedDate = date("Y-m-d", strtotime($request->proposedDate));
        $reqlist->proposedTime = date("H:i:s", strtotime($request->proposedTime));
        $reqlist->studentLevel = $request->studentLevel;
        $reqlist->numStudent = $request->numStudent;
        $reqlist->schoolID = auth()->user()->schoolID;

        $reqlist->save();

        return redirect()->back()->with('message', 'A new tutorial request has been successfuly created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestRequest  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateRequestRequest $request, Request $request)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
