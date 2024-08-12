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

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = course::find($id);
        $course->delete();
    }

    public function data()
    {

        
           
        $courses = Course::select(['id', 'course_name', 'status', 'semesters']);

        return DataTables::of($courses)
            ->editColumn('status', function($course) {
                $statusClass = $course->status == 'Active' ? 'label-success' : 'label-danger';
                return '<span class="label ' . $statusClass . '">' . $course->status . '</span>';
            })
            ->addColumn('action', function($course) {
                return '<a href="'.route('course.edit', $course->id).'" class="btn btn-primary btn-sm">Edit</a>
                        <a href="'.route('course.delete', $course->id).'" class="btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
}
