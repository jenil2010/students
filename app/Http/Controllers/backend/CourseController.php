<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class CourseController extends Controller
{

    private $CourseRepository;
    public function __construct(CourseRepository $CourseRepository)
    {
        $this->CourseRepository = $CourseRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = $this->CourseRepository->all();
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
        
        $validation = validator($params,[
            'course_name' => 'required',
            'duration' => 'required',
            'status' => 'required',
            'semesters' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->CourseRepository->create($params);
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
        $course = $this->CourseRepository->find($id);
        // dd($course);
        return view('backend.course.update', compact('course','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $this->CourseRepository->update($id,$params);

        return redirect()->route('course.index')->with(['status' => 'Course Updated Succesfully', 'alert-type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->CourseRepository->delete($id);
        return redirect()->route('course.index')->with(['status' => 'Course Deleted Successfully.' , 'alert-type' => 'danger']);
    }

    public function data()
    {
  
        $course = $this->CourseRepository->data();
        return DataTables::of($course)->make(true);
    }
    
}
