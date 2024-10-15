<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\beds;
use App\Models\Fees;
use App\Models\hostels;
use App\Models\Student_map;
use App\Models\Students;
use Carbon\Carbon;
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
        $hostel = $request->hostel_id;
        $year = $request->year;
        $gender = $request->gender;
        // dd($hostel);

        $admission = Addmission::all();
        $student = Students::all();
        $beds = beds::all();
        $students = Student_map::when($year, function($query) use ($year) {
            list($startYear, $endYear) = explode('-', $year);
            return $query->whereYear('created_at', '>=', $startYear)
                         ->whereYear('created_at', '<=', $endYear);
        })
        ->when($hostel, function($query) use ($hostel) {
            return $query->where('hostel_id', $hostel);
        })
        ->when($gender, function($query) use ($gender) {
            return $query->wherehas('admission', function($query) use ($gender){
                return $query->where('gender',$gender);
            });
        })->with('admission','student','beds')->get();
        // $students = beds::when($year, function($query) use ($year) {
        //     list($startYear, $endYear) = explode('-', $year);
        //     return $query->whereYear('created_at', '>=', $startYear)
        //                  ->whereYear('created_at', '<=', $endYear);
        // })->with('admission','student','beds')->get();
        // dd($student);
        // dd($student);
        return DataTables::of($students)->make(true);
    }

    public function bedRelease($id){
        $beds = student_map::where('addmission_id',$id)->first();
        beds::where('id',$beds->bed_id)->update([
            'status' => 0
        ]);
        // dd($beds); 
        Student_map::where('addmission_id',$id)->update([
            'hostel_id' => null,
            'room_id' => null,
            'bed_id' => null,
            'is_bed_release' => 0
        ]);

        return redirect()->route('report.index')->with(['status' => 'Bed Released Succesfully' , 'alert-type' => 'success']);
    }

    public function dueFees(Request $request){
        $genderId = $request->gender;
        $studentId = $request->student_id;
        $hostelId = $request->hostel_id;
        $addmission = Addmission::all()->pluck('is_admission_confirm')->values();
        $feesstatus = Addmission::all()->pluck('is_fees_paid')->values();
        // dd($feesstatus);
        $confirmation = $addmission;
        // $feesstatus = $addmission;
        if ($feesstatus->contains(fn($value) => $value != 1) ) {
            foreach($confirmation as $key => $value){
                if($value == 1){
                    $admission = Addmission::when($genderId, function($query) use($genderId){
                        return $query->where('gender',$genderId);
                    })->when($studentId, function($query) use($studentId){
                        return $query->where('student_id',$studentId);
                    })->when($hostelId, function($query) use ($hostelId){
                        return $query->where('hostel_id',$hostelId);
                    })->where('is_fees_paid',0)->where('is_admission_confirm',1)->get();
                    // dd($admission);
                    return DataTables::of($admission)->make(true);
                }
            }
        } 
    // else {
    //         // $fees = Fees::all()->pluck('payment_method');
    //         $currentDate = Carbon::now();

    // // Get due payments based on payment method
    //     $duePayments = Fees::where(function($query) use ($currentDate) {
    //         $query->where('payment_method', 'Monthly')
    //             ->whereDate('paid_at', '<=', $currentDate->subDays(30))
    //         ->orWhere(function($query) use ($currentDate) {
    //             $query->where('payment_method', 'Quarterly')
    //                     ->whereDate('paid_at', '<=', $currentDate->subMonths(3));
    //         })
    //         ->orWhere(function($query) use ($currentDate) {
    //             $query->where('payment_method', 'Half Yearly')
    //                     ->whereDate('paid_at', '<=', $currentDate->subMonths(6));
    //         })
    //         ->orWhere(function($query) use ($currentDate) {
    //             $query->where('payment_method', 'Yearly')
    //                     ->whereDate('paid_at', '<=', $currentDate->subYear());
    //         });
    //     })->get();

    //     dd($duePayments);
    //     }
        
    }

    public function duefeesView(){
        $hostel = hostels::all();
        $student = Students::all();
        $year = $this->getNextFiveYears();
        return view('backend.reports.dueFees',compact('hostel','year','student'));
    }
}
