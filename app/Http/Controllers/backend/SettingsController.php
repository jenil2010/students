<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oldDate = Settings::where('key','old_admission_date')->value('value');
        $newDate = Settings::where('key','new_admission_date')->value('value');
        $oldData = Settings::where('key','old_admission_label')->value('value');
        $newData = Settings::where('key','new_admission_label')->value('value');
        $startTime = Settings::where('key','start_attendance')->value('value');
        $endTime = Settings::where('key','end_attendance')->value('value');
        return view('backend.settings.index',compact('oldDate','newDate','oldData','newData','startTime','endTime'));
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
        $settings = $request->input('setting', []);
        // if (empty($settings)) {
        //     return redirect()->back()->with(['status' => 'No settings data provided', 'alert-type' => 'danger']);
        // }
    
        foreach ($settings as $item) {
            // if (!isset($item['key']) || !isset($item['value'])) {
            //     return redirect()->back()->with(['status' => 'Invalid data', 'alert-type' => 'danger']);
            // }
            Settings::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value']]
            );
        }
    
        return redirect()->back()->with(['status' => 'Settings Changed Successfully', 'alert-type' => 'success']);
    
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
}
