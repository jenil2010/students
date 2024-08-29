<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roleId = Role::where('name','Admin')->pluck('id')->first();
        // $user = User::where('role_id',$roleId)->first();
        // dd($user);
        return view('backend.admin_user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::where('name','Admin')->first();
        return view('backend.admin_user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin_user =  $request->all();
        // dd($request->all());
        $validation = validator($admin_user,[
            'name' => 'required',
            'password' => 'required',
            'email' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        User::create([
            'name' => $admin_user['name'],
            'email' => $admin_user['email'],
            'password' => Hash::make($admin_user['password']),
            'role_id' => $admin_user['role_id'],
        ]);

        return redirect()->route('admin.index')->with(['status' => 'Student is Created Succesfully', 'alert-type' => 'success']);
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
        $user = User::find($id);
        $role = Role::where('name','Admin')->first();
        return view('backend.admin_user.update',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = User::find($id);
        $admin_user =  $request->all();
        // dd($request->all());
        $validation = validator($admin_user,[
            'name' => 'required',
            'password' => 'required',
            'email' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $params->update([
            'name' => $admin_user['name'],
            'email' => $admin_user['email'],
            'password' => Hash::make($admin_user['password']),
            'role_id' => $admin_user['role_id'],
        ]);

        return redirect()->route('admin.index')->with(['status' => 'Student is Created Succesfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        $admin->delete();
    }

    public function data()
    {
        $roleId = Role::where('name','Admin')->pluck('id')->first();
        $user = User::where('role_id',$roleId)->get();
        // dd($user);
        
        return DataTables::of($user)->make();
    }
}
