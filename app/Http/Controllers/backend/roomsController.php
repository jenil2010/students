<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\hostels;
use App\Models\rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class roomsController extends Controller
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
    public function create()
    {
        $rooms = rooms::all();
        $hostel = hostels::all();
        return view('backend.rooms.create',compact('rooms','hostel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rooms = $request->all();

        $validation = Validator::make($rooms,[
            'hostel_id' => 'required',
            'room_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        rooms::create($rooms);
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
    public function edit(string $id)
    {
        $rooms = rooms::find($id);
        $hostel = hostels::all();
        return view('backend.rooms.update',compact('rooms','id','hostel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rooms = rooms::find($id);

        $params = $request->all();

        $validation = Validator::make($params,[
            'hostel_id' => 'required',
            'room_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $rooms->update($params);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rooms = rooms::find($id);
        $rooms->delete();
    }
}
