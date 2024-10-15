<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\hostels;
use App\Models\wardens;
use App\Repositories\HostelRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class hostelController extends Controller
{
    private $HostelRepository;
    public function __construct(HostelRepository $HostelRepository)
    {
        $this->HostelRepository = $HostelRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostel = $this->HostelRepository->all();
        $warden = wardens::all();
        return view('backend.hostels.index',compact('hostel','warden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warden = wardens::all();
        return view('backend.hostels.create',compact('warden'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hostel = $request->all();

        $validation = validator($hostel,[
            'hostel_name' => 'required',
            'location' => 'required',
            'contact_number' => 'required|integer|digits:10',
            'mobile_number' => 'required|integer|digits:10',
            'status' => 'required',
            'warden_id' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->HostelRepository->create($hostel);
        return redirect()->route('hostel.index')->with(['status' => 'Hostel is Created Succesfully' , 'alert-type' => 'success']);
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
    public function edit(Request $request,string $id)
    {
        $hostel = $this->HostelRepository->find($id);
        $warden = wardens::all();
        return view('backend.hostels.update',compact('hostel','warden','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        $params = $request->all();

        $validation = Validator::make($params,[
            'hostel_name' => 'required',
            'location' => 'required',
            'contact_number' => 'required|integer|digits:10',
            'mobile_number' => 'required|integer|digits:10',
            'status' => 'required',
            'warden_id' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->HostelRepository->update($id,$params);
        return redirect()->route('hostel.index')->with(['status' => 'Hostel is Updated Succesfully' , 'alert-type' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->HostelRepository->delete($id);
        return redirect()->route('hostel.index')->with(['status' => 'Hostel is Deleted Succesfully' , 'alert-type' => 'danger']);

    }
    public function data()
    {
        $hostel = $this->HostelRepository->data();
        return DataTables::of($hostel)->make(true);

    }
}
