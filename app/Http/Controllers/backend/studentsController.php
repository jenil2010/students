<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\country;
use App\Models\Role;
use App\Models\Students;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class studentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = country::all();
        return view('backend.students.index',compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = country::all();
        // dd($country);
        $role = Role::where('name','student')->first();
        return view('backend.students.create',compact('country','role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = $request->all();
        // dd($student);
        $validation = validator($student,[
            'first_name' => 'required|alpha:ascii',
            'middle_name' => 'required|alpha:ascii',
            'last_name' => 'required|alpha:ascii',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'dob' => 'required|date',
            'gender' =>'required',
            'address' => 'required',
            'status' => 'required',
            'password' => 'required',
            'country_id' => 'required',
            'village' => 'required',
            'is_any_illness' => 'nullable|boolean',
            'illness_description' => 'required_if:is_any_illness,1'
        ]);
        
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $student['name'] = $student['first_name'].' '.$student['last_name'];
        $user = User::create([
            'name' => $student['name'],
            'email' => $student['email'],
            'password' => Hash::make($student['password']),
            'role_id' => $student['role_id'],
        ]);
        
        $student['user_id'] = $user->id;
        
        Students::create($student);
        
        return redirect()->route('students.index')->with(['status' => 'Student is Created Succesfully', 'alert-type' => 'success']);

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
        $country = country::all();
        $student = Students::find($id);
        $role = Role::where('name','student')->first();
        return view('backend.students.update',compact('student','role','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Students::find($id);
        $user = User::find($id);
        $params = $request->all();
      
        $validation = validator($params,[
            'first_name' => 'required|alpha:ascii',
            'middle_name' => 'required|alpha:ascii',
            'last_name' => 'required|alpha:ascii',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'dob' => 'required|date',
            'gender' =>'required',
            'address' => 'required',
            'status' => 'required',
            'password' => 'required',
            'country_id' => 'required',
            'village' => 'required',
            'is_any_illness' => 'nullable|boolean',
            'illness_description' => 'required_if:is_any_illness,1'
        ]);
        
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $params['name'] = $params['first_name'].' '.$params['last_name'];
        $user->update([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
            'role_id' => $params['role_id'],
        ]);

        $student->update($params);
        // $user->update()
        return redirect()->route('students.index')->with(['status' => 'Student is Updated Succesfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function data(Request $request){
        // $query = Students::query();

        // Apply filters if they are provided
        // if ($request->has('gender') && !empty($request->gender)) {
        //     $query->where('gender', $request->gender);
        // }
        
        // if ($request->has('country_id') && !empty($request->country_id)) {
        //     $query->where('country_id', $request->country_id);
        //     // dd($query);
        // }
        // $data = Students::where('gender', $gender)
        //              ->where('country_id', $country_id)
        //              ->get();
    
        // Fetch data from the query
        $genderId = $request->gender_id;
        $countryId = $request->country_id;
        $students =  Students::when($genderId, function ($query) use ($genderId) {
            return $query->where('gender', $genderId);
          })
          ->when($countryId, function ($query) use ($countryId) {
            return $query->where('country_id', $countryId);
          })
          ->orderBy("created_at", "desc")->get();
        // $students = Students::with()->get();
    
        // Prepare data for DataTables
        // $data = [
        //     'data' => $data,
        //     'recordsTotal' => $data->count(),
        //     'recordsFiltered' => $data->count(),
        // ];
    
        return DataTables::of($students)->make();
    
    }
}
