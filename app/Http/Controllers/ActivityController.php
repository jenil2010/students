<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alllogs = Activity::with('user')->get();

        $formattedlog = $alllogs->map(function($log) {
            // Decode the properties JSON
            $properties = json_decode($log->properties, true);

            // Extract attributes
            $attributes = $properties['attributes'] ?? [];

            return [
                'properties' => json_encode($attributes), 
                'id' => $log->id,
                'description' => $log->description,
                'causer' => $log->user->name ?? '',
                'created_at' => $log->created_at->format('d/m/Y'),
            ];
        });

        // Convert the entire collection to an array
        return DataTables::of($formattedlog)->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Activitylog.index');
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
}
