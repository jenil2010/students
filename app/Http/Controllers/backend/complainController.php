<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Complains;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class complainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.complain.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.complain.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $complain = $request->all();
        $userId = auth()->user()->id;
        $complain['complain_by'] = $userId;
        // dd($userId);
        $validation = validator($complain,[
            'complain_by' => 'required',
            'message' => 'required',
            'type' => 'required',
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        // dd($complain);
        Complains::create($complain);
        return redirect()->route('complain.index')->with(['status' => 'complain is Created Succesfully', 'alert-type' => 'success']);

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
        $complain = Complains::find($id);
        // dd($complain);
        return view('backend.complain.update',compact('complain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $complain = Complains::find($id);
        $params = $request->all();
        $userId = auth()->user()->id;
        $params['complain_by'] = $userId;
        // dd($userId);
        $validation = validator($params,[
            'complain_by' => 'required',
            'message' => 'required',
            'type' => 'required',
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $complain->update($params);
        return redirect()->route('complain.index')->with(['status' => 'complain is Updated Succesfully', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complain = Complains::find($id);
        $complain->delete();
        return redirect()->route('complain.index')->with(['status' => 'complain is Updated Succesfully', 'alert-type' => 'success']);
    }

    public function data(){
        $complain = Complains::query()->get();
        return DataTables::of($complain)->make(true);
    }
}
