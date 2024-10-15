<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\beds;
use App\Models\country;
use App\Models\course;
use App\Models\Doctype;
use App\Models\Fees;
use App\Models\hostels;
use App\Models\rooms;
use App\Models\Student_map;
use App\Models\Studentdocuments;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Mail;
use Yajra\DataTables\Facades\DataTables;

class addmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user());
        $hostel = hostels::all();
        $addmission = Addmission::all();
        $rooms = collect();
        $beds = collect();
        return view(
            "backend.addmission.index",
            compact("addmission", "hostel", "rooms", "beds")
        );
    }

    public function getNextFiveYears()
    {
        $nextFiveYears = [];
        $currentYear = date("Y");

        for ($i = 0; $i < 5; $i++) {
            $startYear = $currentYear + $i;
            // dd($startYear);
            // $endYear = $currentYear + $i + 1;
            $nextFiveYears[] = "$startYear";
        }

        return $nextFiveYears;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Students::all();
        $country = country::all();
        $year = $this->getNextFiveYears();
        $course = course::all()
            ->pluck("course_name", "id")
            ->toArray();
        $doc = Doctype::get()
            ->pluck("type", "id")
            ->toArray();
        $sem = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        // dd($year);
        return view(
            "backend.addmission.create",
            compact("student", "country", "doc", "course", "sem", "year")
        );
    }
    public function load(Request $request)
    {
        $filterStudent = Students::where("id", $request->id)->first();
        // dd($filterStudent);
        return response()->json($filterStudent);
        // return view('backend.addmission.create',compact('student'));
    }

    public function getRoom(Request $request)
    {
        if ($request->hostel_id > 0) {
            $rooms = rooms::where("hostel_id", $request->hostel_id)->get();
        } else {
            $rooms = "NO Room Found";
        }
        return response()->json($rooms);
    }

    public function getBeds(Request $request)
    {
        if ($request->room_id > 0) {
            $beds = beds::where("room_id", $request->room_id)->get();
            // dd($beds);
        } else {
            $beds = "NO Bed Found";
        }
        return response()->json($beds);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = $request->input('studentId');


        // dd($user);
        $student = $request->all();
        $rules = [
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "phone" => "required",
            "email" => "required|email",
            "dob" => "required",
            "gender" => "required",
            "country_id" => "required",
            "address" => "required",
            "village" => "required",
            "adhaar_number" => "required",
            "nationality" => "required",
            "is_any_illness" => "nullable|in:null,1",
            "vehicle" => "required|in:0,1",
            "father_full_name" => "required",
            "father_phone" => "required",
            "father_occupation" => "required",
            "mother_full_name" => "required",
            "mother_phone" => "required",
            "mother_occupation" => "required",
            "annual_income" => "required",
            "guardian_name" => "required",
            "guardian_relation" => "required",
            "guardian_phone" => "required",
            "course_id" => "required",
            "semester" => "required",
            "institute_name" => "required",
            "year_of_addmission" => "required",
            "addmission_date" => "required",
            "college_start_time" => "required",
            "college_end_time" => "required",
            "college_fees_receipt_no" => "required",
            "college_fees_receipt_date" => "required",
            "arriving_date" => "required",
            "student_photo_url" => "required",
            "parent_photo_url" => "required",
        ];

        if ($request->input("is_any_illness") === "1") {
            $rules["illness_description"] = "required";
        }
        if ($request->input("vehicle") === "1") {
            $rules["is_have_helmet"] = "required";
            $rules["vehicle_number"] = "required";
            $rules["licence_doc_url"] = "required";
            $rules["rcbook_front_doc_url"] = "required";
            $rules["rcbook_back_doc_url"] = "required";
            $rules["insurance_doc_url"] = "required";
        }

        $validation = validator($student, $rules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        // dd($validation->fails());

        if ($request->input("vehicle") === "1") {
            if ($request->has("licence_doc_url")) {
                $image = $request->file("licence_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["licence_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($request->has("rcbook_front_doc_url")) {
                $image = $request->file("rcbook_front_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["rcbook_front_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($request->has("rcbook_back_doc_url")) {
                $image = $request->file("rcbook_back_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["rcbook_back_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        if ($request->has("student_photo_url")) {
            $image = $request->file("student_photo_url");
            // dd($image);
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = public_path("assets/image") . "/" . $imageName;

            $image->move(public_path("assets/image"), $imageName);

            $imageData = file_get_contents($imagePath);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);

            $base64Image =
                "data:image/" . $type . ";base64," . base64_encode($imageData);
            $student["student_photo_url"] = $base64Image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // dd($student['student_photo_url']);
        if ($request->has("parent_photo_url")) {
            $image = $request->file("parent_photo_url");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = public_path("assets/image") . "/" . $imageName;
            $image->move(public_path("assets/image"), $imageName);

            $imageData = file_get_contents($imagePath);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);

            $base64Image =
                "data:image/" . $type . ";base64," . base64_encode($imageData);
            $student["parent_photo_url"] = $base64Image;
            // $params['user_image'] = $params['userimage'];
            // dd($params['user_image']);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // dd($student);

        $rulesDoc = [
            "group-a.*.doctype" => "required",
            "group-a.*.doc" => "required",
            "group-a.*.percentile" => "nullable",
            "group-a.*.result_Status" => "required",
        ];

        $validation = validator($student, $rulesDoc);

        foreach ($student["group-a"] as &$item) {
            $fileKey =
                "group-a." . array_search($item, $student["group-a"]) . ".doc";
            // dd($fileKey);
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                // dd($file);
                $fileName = time() . "_" . $file->getClientOriginalName();
                $filePath = public_path("assets/documents") . "/" . $fileName;
                $file->move(public_path("assets/documents"), $fileName);
                $item["doc"] = $filePath ?? null;
            }
            $item["doctype"] = $item["doctype"] ?? null;
            $item["percentile"] = $item["percentile"] ?? null;
            $item["result_Status"] = $item["result_Status"] ?? null;
        }
        // dd($item['doc']);
        $studentId = Students::where("id", $request->input('studentId'))
            ->pluck("id")
            ->first();
        // dd($studentId);
        foreach ($student["group-a"] as $item) {
            $existingDoc = Studentdocuments::where("student_id", $studentId)
                ->where("doctype", $item["doctype"])
                ->first();

            if ($existingDoc) {
                $existingDoc->update([
                    "doc" => $item["doc"],
                    "percentile" => $item["percentile"],
                    "result_Status" => $item["result_Status"],
                ]);
            } else {
                Studentdocuments::create([
                    "student_id" => $studentId,
                    "doctype" => $item["doctype"],
                    "doc" => $item["doc"],
                    "percentile" => $item["percentile"],
                    "result_Status" => $item["result_Status"],
                ]);
            }
        }

        Addmission::create($student);
        return redirect()->back();
    }

    public function note(Request $request)
    {
        $id = $request->input("student_id");
        // dd($id);
        $Addmission = Addmission::where('student_id',$id)->first();
        
        $email = $Addmission['email'];
        $student = [];
        $student["is_admission_confirm"] = $request->input("admission_status");
        $student["note"] = $request->input("remark");
        $data = [
            'student' => $student,
            'Addmission' => $Addmission,
        ];
        Mail::send('backend.mail.addmission_confirm', $data, function($message) use ($email) {
            $message->to($email)
                    ->subject('Admission Responce');
                    
        });
        Addmission::where("student_id", (int) $id)->update($student);

        return redirect()->route("addmission.index");
    }

    public function fees(Request $request)
    {
        $admission = Addmission::where(
            "student_id",
            $request->addmission_id
        )->first();
        $student = $request->all();
        $student = $request->except("_token");

        // Set up start year for financial calculations
        $start_year = date("Y") . "-04-01";
        $startYear = new DateTime($start_year);
        $now = new DateTime();

        if ($now > $startYear) {
            $financialYear =
                $now->format("y") . "-" . $now->modify("+1 year")->format("y");
        } else {
            $financialYear =
                $now->modify("-1 year")->format("y") . "-" . $now->format("y");
        }

        // Add financial year to student data
        $student["financial_year"] = $financialYear;

        // Get the next serial number
        $maxId = DB::table("fees")->max("id");
        $nextId = $maxId ? $maxId + 1 : 1;
        $student["serial_number"] = $nextId;

        if ($admission) {
            $student["student_name"] =
                $admission->first_name .
                " " .
                $admission->middle_name .
                " " .
                $admission->last_name;
            // Ensure the correct value is set for student_name
            $student["father_name"] = $admission->father_full_name;
            $student["address"] = $admission->address;
        } else {
            return redirect()
                ->route("addmission.index")
                ->withErrors("Admission record not found.");
        }

        $student["paid_at"] = date("Y-m-d");
        // dd($student);
        // dd($admission);
        Fees::create($student);
        Addmission::where("student_id", $request->addmission_id)->update([
            "is_fees_paid" => $student["status"],
        ]);

        return redirect()->route("addmission.index");
    }

    public function Reserve(Request $request)
    {
        $data = $request->all();
       

        $validation = validator($data, [
            "student_id" => "required",
            "addmission_id" => "required",
            "hostel_id" => "required",
            "room_id" => "required",
            "bed_id" => "required",
        ]);

        if ($validation->fails()) {
            return redirect()
                ->back()
                ->withErrors($validation)
                ->withInput();
        }

        $year = date("Y");
        $existingReservation = Student_map::where(
            "student_id",
            $request->student_id
        )
            ->where("addmission_id", $request->addmission_id)
            ->first();
            



        if ($existingReservation) {
            $existingReservation->update([
                "hostel_id" => $request->hostel_id,
                "room_id" => $request->room_id,
                "bed_id" => $request->bed_id,
                "addmission_year" => $year,
                "is_bed_release" => 1,
            ]);

            $bed = beds::where('room_id',$request->room_id)
                    ->where('id',$request->bed_id)
                    ->update([
                        'status' => 1,
                    ]);
                    $admission = Addmission::where('id',$request->addmission_id)->first();
                    $email = $admission['email'];
                    $hostel = hostels::where('id',$request->hostel_id)->first();
                    $room = rooms::where('id',$request->room_id)->first();
                    $bed = beds::where('id',$request->bed_id)->first();
                    $data = [
                        'hostel' => $hostel,
                        'admission' => $admission,
                        'room' => $room,
                        'bed' => $bed,
                    ];
                    Mail::send('backend.mail.room', $data, function($message) use ($email) {
                        $message->to($email)
                                ->subject('Room Allotment');
                                
                    });
        // dd($bed);

            return redirect()
                ->route("addmission.index")
                ->with([
                    "status" => "Room Reservation Updated Succesfully",
                    "alert-type" => "warning",
                ]);
        } else {
            $newReservation = Student_map::create([
                "student_id" => $request->student_id,
                "addmission_id" => $request->addmission_id,
                "hostel_id" => $request->hostel_id,
                "room_id" => $request->room_id,
                "bed_id" => $request->bed_id,
                "addmission_year" => $year,
                "is_bed_release" => 1,
            ]);
            beds::where('id',$request->bed_id)->update([
                        'status' => 1,
                    ]);
                    $admission = Addmission::where('id',$request->addmission_id)->first();
                    $email = $admission['email'];
                    $hostel = hostels::where('id',$request->hostel_id)->first();
                    $rooms = rooms::where('id',$request->room_id)->first();
                    $bed = beds::where('id',$request->bed_id)->first();
                    $data = [
                        'hostel' => $hostel,
                        'admission' => $admission,
                        'rooms' => $rooms,
                        'bed' => $bed,
                    ];
                    Mail::send('backend.mail.room', $data, function($message) use ($email) {
                        $message->to($email)
                                ->subject('Room Allotment');
                                
                    });

            return redirect()
                ->route("addmission.index")
                ->with([
                    "status" => "Room Alloted Succesfully",
                    "alert-type" => "success",
                ]);
        }
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
        $addmission = Addmission::find($id);
        $country = country::all();
        $year = $this->getNextFiveYears();
        $course = course::all()
            ->pluck("course_name", "id")
            ->toArray();
        $doc = Doctype::get()
            ->pluck("type", "id")
            ->toArray();
        $sem = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        return view(
            "backend.addmission.update",
            compact("addmission", "country", "year", "course", "doc", "sem")
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::id();
        // dd($user);
        $addmission = Addmission::find($id);
        $student = $request->all();
        $rules = [
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "phone" => "required",
            "email" => "required|email",
            "dob" => "required",
            "gender" => "required",
            "country_id" => "required",
            "address" => "required",
            "village" => "required",
            "adhaar_number" => "required",
            "nationality" => "required",
            "is_any_illness" => "nullable|in:null,1",
            "vehicle" => "required|in:0,1",
            "father_full_name" => "required",
            "father_phone" => "required",
            "father_occupation" => "required",
            "mother_full_name" => "required",
            "mother_phone" => "required",
            "mother_occupation" => "required",
            "annual_income" => "required",
            "guardian_name" => "required",
            "guardian_relation" => "required",
            "guardian_phone" => "required",
            "course_id" => "required",
            "semester" => "required",
            "institute_name" => "required",
            "year_of_addmission" => "required",
            "addmission_date" => "required",
            "college_start_time" => "required",
            "college_end_time" => "required",
            "college_fees_receipt_no" => "required",
            "college_fees_receipt_date" => "required",
            "arriving_date" => "required",
            "student_photo_url" => "required",
            "parent_photo_url" => "required",
        ];

        if ($request->input("is_any_illness") === "1") {
            $rules["illness_description"] = "required";
        }
        if ($request->input("vehicle") === "1") {
            $rules["is_have_helmet"] = "required";
            $rules["vehicle_number"] = "required";
            $rules["licence_doc_url"] = "required";
            $rules["rcbook_front_doc_url"] = "required";
            $rules["rcbook_back_doc_url"] = "required";
            $rules["insurance_doc_url"] = "required";
        }

        $validation = validator($student, $rules);

        // if ($validation->fails()) {
        //     return redirect()->back()->withErrors($validation)->withInput();
        // }
        // dd($validation->fails());

        if ($request->input("vehicle") === "1") {
            if ($request->has("licence_doc_url")) {
                $image = $request->file("licence_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["licence_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($request->hasFile("rcbook_front_doc_url")) {
                $image = $request->file("rcbook_front_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["rcbook_front_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if ($request->hasFile("rcbook_back_doc_url")) {
                $image = $request->file("rcbook_back_doc_url");
                $imageName = time() . "_" . $image->getClientOriginalName();
                $imagePath = public_path("assets/image") . "/" . $imageName;
                $image->move(public_path("assets/image"), $imageName);

                $imageData = file_get_contents($imagePath);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);

                $base64Image =
                    "data:image/" .
                    $type .
                    ";base64," .
                    base64_encode($imageData);
                $student["rcbook_back_doc_url"] = $base64Image;
                // $params['user_image'] = $params['userimage'];
                // dd($params['user_image']);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        if ($request->hasFile("student_photo_url")) {
            $image = $request->file("student_photo_url");
            // dd($image);
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = public_path("assets/image") . "/" . $imageName;

            $image->move(public_path("assets/image"), $imageName);

            $imageData = file_get_contents($imagePath);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);

            $base64Image =
                "data:image/" . $type . ";base64," . base64_encode($imageData);
            $student["student_photo_url"] = $base64Image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // dd($student['student_photo_url']);
        if ($request->hasFile("parent_photo_url")) {
            $image = $request->file("parent_photo_url");
            $imageName = time() . "_" . $image->getClientOriginalName();
            $imagePath = public_path("assets/image") . "/" . $imageName;
            $image->move(public_path("assets/image"), $imageName);

            $imageData = file_get_contents($imagePath);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);

            $base64Image =
                "data:image/" . $type . ";base64," . base64_encode($imageData);
            $student["parent_photo_url"] = $base64Image;
            // $params['user_image'] = $params['userimage'];
            // dd($params['user_image']);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // dd($student);

        $rulesDoc = [
            "group-a.*.doctype" => "nullable",
            "group-a.*.doc" => "nullable",
            "group-a.*.percentile" => "nullable",
            "group-a.*.result_Status" => "nullable",
        ];

        $validation = validator($student, $rulesDoc);

        foreach ($student["group-a"] as &$item) {
            $fileKey =
                "group-a." . array_search($item, $student["group-a"]) . ".doc";
            // dd($fileKey);
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                // dd($file);
                $fileName = time() . "_" . $file->getClientOriginalName();
                $filePath = public_path("assets/documents") . "/" . $fileName;
                $file->move(public_path("assets/documents"), $fileName);
                $item["doc"] = $filePath;
            } else {
                $item["doctype"] = null;
            }
            $item["doctype"] = $item["doctype"] ?? null;
            $item["percentile"] = $item["percentile"] ?? null;
            $item["result_Status"] = $item["result_Status"] ?? null;
        }
        // dd($item['doc']);
        $studentId = Students::where("user_id", $user)
            ->pluck("id")
            ->first();

        foreach ($student["group-a"] as $item) {
            $existingDoc = Studentdocuments::where("student_id", $studentId)
                ->where("doctype", $item["doctype"])
                ->first();

            if ($existingDoc) {
                $existingDoc->update([
                    "doc" => $item["doc"],
                    "percentile" => $item["percentile"],
                    "result_Status" => $item["result_Status"],
                ]);
            } else {
                Studentdocuments::create([
                    "student_id" => $studentId,
                    "doctype" => $item["doctype"],
                    "doc" => $item["doc"],
                    "percentile" => $item["percentile"],
                    "result_Status" => $item["result_Status"],
                ]);
            }
        }

        $addmission->update($student);
        return redirect()->back();
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
        $fees = Fees::all();
        $addmission = Addmission::with("fees")->get();
        // dd($addmission);
        return DataTables::of($addmission)->make(true);
    }
}
