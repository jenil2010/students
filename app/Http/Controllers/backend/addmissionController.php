<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\country;
use App\Models\Students;
use Illuminate\Http\Request;

class addmissionController extends Controller
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

        $student = Students::all();
        $country = country::all();
        return view('backend.addmission.create',compact('student','country'));
    }
    public function load(Request $request)
    {
        $filterStudent = Students::where('id',$request->student_id)->first();
        // dd($filterStudent);
        return response()->json($filterStudent);
        // return view('backend.addmission.create',compact('student'));
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
}
