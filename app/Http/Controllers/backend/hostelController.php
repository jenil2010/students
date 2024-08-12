<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\hostels;
use App\Models\wardens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class hostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostel = hostels::all();
        $warden = wardens::all();
        return view('backend.hostels.index',compact('hostel','warden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warden = wardens::all();
        return view('backend.hostels.create',compact('warden'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hostel = $request->all();

        $validation = Validator::make($hostel,[
            'hostel_name' => 'required',
            'location' => 'required',
            'contact_number' => 'required|integer|digits:10',
            'mobile_number' => 'required|integer|digits:10',
            'status' => 'required',
            'warden_id' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        hostels::create($hostel);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $hostel = hostels::find($id);
        $warden = wardens::all();
        return view('backend.hostels.update',compact('hostel','warden','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hostel = hostels::find($id);

        $params = $request->all();

        $validation = Validator::make($params,[
            'hostel_name' => 'required',
            'location' => 'required',
            'contact_number' => 'required|integer|digits:10',
            'mobile_number' => 'required|integer|digits:10',
            'status' => 'required',
            'warden_id' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $hostel->update($params);
        return redirect()->route('hostel.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hostel = hostels::find($id);
        $hostel->delete();
        return redirect()->route('hostel.index');

    }
    public function data()
    {
        $hostel = hostels::query()->get();
        return DataTables::of($hostel)->make(true);
        // return redirect()->route('hostel.index');

    }
}
