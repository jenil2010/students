<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class leaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.leave.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $leave = $request->all();
        $userId = auth()->user()->id;
        // dd($userId);
        $leave['leave_apply_by'] = $userId;
        $leave['note'] = '';

        $validation = validator($leave,[
            'leave_from' => 'required',
            'reason' => 'required',
            'leave_to' => 'required',
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        Leave::create($leave);
        return redirect()->route('leave.index')->with(['status' => 'Leave is Created Succesfully', 'alert-type' => 'success']);
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
        $leave = Leave::find($id);
        return view('backend.leave.update',compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leave = Leave::find($id);
        // $params = $request->all();
        $userId = auth()->user()->id;
        $students = Students::where('user_id',$userId)->pluck('user_id')->first();
        // dd($students == $userId);
        // dd($userId);
        if($students !== $userId) {
            $params = $request->all();
            $params['approve_by'] = $userId;
            $validation = validator($params,[
                'note' => 'required',
            ]);
        }  else {
            $params = $request->all();
            $params['leave_apply_by'] = $userId;
            $params['note'] = '';
            $validation = validator($params,[
                'leave_from' => 'required',
                'reason' => 'required',
                'leave_to' => 'required',
            ]);
        }
        // if ($userId !== 3) {
        //     $leave['approve_by'] = $userId;
        //     $validation = validator($params,[
        //         'note' => 'required',
        //     ]);
        // } else {
        //     $leave['leave_apply_by'] = $userId;
        //     $leave['note'] = '';
        //     $validation = validator($params,[
        //         'leave_from' => 'required',
        //         'reason' => 'required',
        //         'leave_to' => 'required',
        //     ]);
        // }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $leave->update($params);
        
        return redirect()->route('leave.index')->with(['status' => 'Leave is Created Succesfully', 'alert-type' => 'success']);
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
        // $students = Students::all();
        // $user = User::get()->toArray();
        // $student = Students::get()->pluck('name')->first();
        // dd($user);
        $leave = Leave::with('applyby', 'approveby')->get();
        return DataTables::of($leave)
            ->make(true);
    }
}