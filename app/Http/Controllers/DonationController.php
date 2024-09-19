<?php

namespace App\Http\Controllers;

use App\Models\Addmission;
use App\Models\Fees;
use App\Models\hostels;
use App\Models\Student_map;
use App\Models\Students;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Students::all();
        return view('backend.Donations.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function data()
    {
        $student_id = Addmission::all()->pluck('student_id');
        $map = Student_map::where('student_id',$student_id)->pluck('hostel_id');
        $hostel = hostels::where('id',$map)->first();
        $fees = Fees::with('addmission')->get();
        return DataTables::of($fees)
            ->make(true);
    }

}
