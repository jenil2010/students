<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\beds;
use App\Models\hostels;
use App\Models\rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $hostel = hostels::all();
        $hostelId = $request->input('hostel_id');
        $rooms = [];

        if ($hostelId) {
            $rooms = rooms::where('hostel_id', $hostelId)->get();
        }

        // return view('hostel_form', compact('rooms'));
        return view('backend.beds.create',compact('hostel','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $HostelId = $request->input('hostel_id');
        $rooms = null;
        if ($HostelId) {
            $rooms = rooms::where('hostel_id',$HostelId)->get();
        }
        $beds = $request->all(); 
        $validation = Validator::make($beds,[
            'hostel_id' => 'required',
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            $rooms = rooms::where('hostel_id', $request->input('hostel_id'))->get();
            return redirect()->back()->withErrors($validation)->withInput()->with('rooms',$rooms);
        }

        beds::create($beds);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beds = beds::find($id);
        $hostel = hostels::all();
        $rooms = rooms::all();
        return view('backend.beds.update',compact('beds','hostel','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beds = beds::find($id);

        $params = $request->all();

        $validation = Validator::make($params,[
            'hostel_id' => 'required',
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beds = beds::find($id);
        $beds->delete();
        return redirect()->back();
    }
}
