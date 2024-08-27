<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\wardens;
use Hash;
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
        
        $role = Role::where('name','warden')->first();
        return view('backend.wardens.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warden = $request->all();
        // dd($warden);
        $validation = validator($warden,[
            'first_name' => 'required|alpha:ascii',
            'last_name' => 'required|alpha:ascii',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'dob' => 'required|date',
            'gender' =>'required',
            'address' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'status' => 'required',
            'password' => 'required'

        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $warden['name'] = $warden['first_name'].' '.$warden['last_name'];
        $user = User::create([
            'name' => $warden['name'],
            'email' => $warden['email'],
            'password' => Hash::make($warden['password']),
            'role_id' => $warden['role_id'],
        ]);
        // dd($user);
        $warden['user_id'] = $user->id;
        
        // dd($warden);
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
        $role = Role::where('name','warden')->first();
        // dd($warden);
        return view('backend.wardens.update',compact('warden','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warden = wardens::find($id);
        $user = User::find($id);
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

        $params['name'] = $params['first_name'].' '.$params['last_name'];
        $user->update([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
            'role_id' => $params['role_id'],
        ]);

        $warden->update($params);
        // $user->update()
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
        $user = User::all();
        $warden = wardens::with('user')->get();
        return DataTables::of($warden)
            ->make(true);
    }
}
