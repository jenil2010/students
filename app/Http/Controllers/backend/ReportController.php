<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\beds;
use App\Models\hostels;
use App\Models\Student_map;
use App\Models\Students;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostel = hostels::all();
        $year = $this->getNextFiveYears();
        return view('backend.reports.allotedStudent',compact('hostel','year'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    public function allotedStuent(Request $request){
        $hostel = $request->input('hostel_id');
        $admission = Addmission::all();
        $student = Students::all();
        $beds = beds::all();
        $student = Student_map::with('admission','student','beds')
        ->when($hostel, function($query) use ($hostel) {
            return $query->wherehas('beds', function($query) use ($hostel){
                return $query->where('hostel_id',$hostel);
            });
        })
        ->get();
        // dd($student);
        // dd($student);
        return DataTables::of($student)->make(true);
    }
}
