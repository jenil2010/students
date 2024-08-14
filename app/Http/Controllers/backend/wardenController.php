<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\wardens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class wardenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warden = wardens::all();
        return view('backend.wardens.index',compact('warden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.wardens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warden = $request->all();

        $validation = Validator::make($warden,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer|digits:10',
            'dob' => 'required',
            'gender' =>'required',
            'address' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'status' => 'required'

        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        wardens::create($warden);
        return redirect()->route('warden.index')->with(['status' => 'Warden is Created Succesfully', 'alert-type' => 'success']);
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
        $warden = wardens::find($id);
        return view('backend.wardens.update',compact('warden','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warden = wardens::find($id);

        $params = $request->all();

        $validation = Validator::make($params,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer|digits:10',
            'dob' => 'required',
            'gender' =>'required',
            'address' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'status' => 'required'

        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $warden->update($params);
        return redirect()->route('warden.index')->with(['status' => 'Warden is Updated Succesfully', 'alert-type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warden = wardens::find($id);
        $warden->delete();
        return redirect()->route('warden.index')->with(['status' => 'Warden is Deleted Succesfully' , 'alert-type' => 'danger']);
    }

    public function data()
    {
        $warden = wardens::query()->get();
        return DataTables::of($warden)
            ->make(true);
    }
}
