<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\beds;
use App\Models\hostels;
use App\Models\rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class bedsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beds = beds::all();
        $hostel = hostels::all();
        $rooms = rooms::all();
        return view('backend.beds.index',compact('beds','hostel','rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $hostel = hostels::all();
        $rooms = collect();
        // dd($rooms);
        return view('backend.beds.create',compact('hostel','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $beds = $request->all(); 
        $validation = validator($beds,[
            'hostel_id' => 'required',
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        beds::create($beds);
        return redirect()->route('beds.index')->with(['status' => 'Bed is Created Succesfully' , 'alert-type' => 'success']);
    }

    public function getRooms(Request $request){
        if($request->hostel_id > 0){
            $rooms = rooms::where('hostel_id',$request->hostel_id)->get();
        } else{
            $rooms = rooms::all();
        }

        return response()->json($rooms);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beds = beds::find($id);
        $hostel = hostels::all();
        $rooms = collect();
        // dd($rooms);

        return view('backend.beds.update',compact('beds','hostel','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beds = beds::find($id);

        $params = $request->all();

        $validation = Validator::make($params,[
            'bed_number' => 'required',
            'status' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $beds->update($params);

        return redirect()->route('beds.index')->with(['status' => 'Bed is Updated Succesfully' , 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beds = beds::find($id);
        if($beds->status == 1){
            return redirect()->route('beds.index')->with(['status' => 'Cannot delete a Booked Bed .' , 'alert-type' => 'warning']);
        }else{
            $beds->delete();
            return redirect()->route('beds.index')->with(['status' => 'Bed Deleted Succesfully .', 'alert-type' => 'danger']);
        }
    }

    public function getNextFiveYears()
    {
        $nextFiveYears = [];
        $currentYear = date("Y");
        
        for ($i = 3; $i > 0; $i--) {
            $startYear = $currentYear - $i;
            $endYear = $currentYear - $i + 1;
            $nextFiveYears[] = "$startYear-$endYear";
        }
        for ($i = 0; $i < 5; $i++) {
            $startYear = $currentYear + $i;
            // dd($startYear);
            $endYear = $currentYear + $i + 1;
            $nextFiveYears[] = "$startYear"."-"."$endYear";
        }


        return $nextFiveYears;
    }

    public function data()
    {
        $hostel = hostels::all();
        $rooms = rooms::all();
        // dd($rooms);
        $beds = beds::with('hostel','rooms')->get();
        return DataTables::of($beds)  
            ->make(true);
    }
    public function Avail_beds()
    {
        $hostel = hostels::all();
        $year = $this->getNextFiveYears();
        // dd($year);
       return view('backend.beds.availableBeds',compact('hostel','year'));
    }
    public function Available(Request $request)
    {
        $hostel = $request->hostel_id;
        $year = $request->year;
    
        $bedsQuery = beds::when($year, function($query) use ($year) {
                list($startYear, $endYear) = explode('-', $year);
                return $query->whereYear('created_at', '>=', $startYear)
                             ->whereYear('created_at', '<=', $endYear);
            })->when($hostel, function($query) use ($hostel) {
                return $query->where('hostel_id', $hostel);
            })->where('status', 0)
            ->with('rooms');
    

        $beds = $bedsQuery->get();
    
        return DataTables::of($beds)
            ->make(true);
    }
    
}
