<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = course::all();
        return view('backend.course.index',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        
        $validation = validator::make($params,[
            'course_name' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'semesters' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        course::create($params);
        return redirect()->route('course.index')->with(['status' => 'Course Created Successfully.' , 'alert-type' => 'success']);
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
        $course = course::find($id);
        // dd($course);
        return view('backend.course.update', compact('course','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = course::find($id);

        $params = $request->all();

        $validation = validator::make($params,[
            'course_name' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'semesters' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $course->update($params);

        return redirect()->route('course.index')->with(['status' => 'Course Updated Succesfully', 'alert-type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = course::find($id);
        $course->delete();
        return redirect()->route('course.index')->with(['status' => 'Course Deleted Successfully.' , 'alert-type' => 'danger']);
    }

    public function data()
    {

        
           
        $course = course::query()->get();
        return DataTables::of($course)->make(true);
    }
    
}
