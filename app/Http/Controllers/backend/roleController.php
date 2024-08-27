<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;


class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $validation = validator($params, [
            'name' => ['required', 'string', 'max:20', 'unique:roles,name'],
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin',
        ]);
        // $role->syncPermissions($request->input('permission'));

        return redirect('Roles/' . $role->id . '/edit')->with('success','Role Created Successfully.!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->{'Tables_in_' . env('DB_DATABASE')}] = $table->{'Tables_in_' . env('DB_DATABASE')};
                }
            }

            $filterArr = [];

            if ($tablesArr['beds']) {
                $filterArr['Beds'] = 'Beds';
            }

            if ($tablesArr['country']) {
                $filterArr['Country'] = 'Country';
            }

            if ($tablesArr['courses']) {
                $filterArr['Courses'] = 'Courses';
            }

            if ($tablesArr['hostels']) {
                $filterArr['Hostels'] = 'Hostels';
            }

            if ($tablesArr['rooms']) {
                $filterArr['Rooms'] = 'Rooms';
            }

            if ($tablesArr['settings']) {
                $filterArr['Settings'] = 'Settings';
            }

            if ($tablesArr['wardens']) {
                $filterArr['wardens'] = 'wardens';
            }

            if ($tablesArr['users']) {
                $filterArr['User'] = 'User';
            }

            $permissionData = new Permissions();
            return view('backend.Roles.show', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->{'Tables_in_' . env('DB_DATABASE')}] = $table->{'Tables_in_' . env('DB_DATABASE')};
                }
            }

            // dd($tablesArr);

            $filterArr = [];

            if ($tablesArr['beds']) {
                $filterArr['Beds'] = 'Beds';
            }

            if ($tablesArr['country']) {
                $filterArr['Country'] = 'Country';
            }

            if ($tablesArr['courses']) {
                $filterArr['Courses'] = 'Courses';
            }

            if ($tablesArr['hostels']) {
                $filterArr['Hostels'] = 'Hostels';
            }

            if ($tablesArr['rooms']) {
                $filterArr['Rooms'] = 'Rooms';
            }

            if ($tablesArr['settings']) {
                $filterArr['Settings'] = 'Settings';
            }

            if ($tablesArr['wardens']) {
                $filterArr['wardens'] = 'wardens';
            }

            if ($tablesArr['users']) {
                $filterArr['User'] = 'User';
            }

            $permissionData = new Permissions();
            return view('backend.Roles.update', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $param = $request->all();
        $role = Role::find($param['id']);
        $validator = Validator::make($param, [
            'name' => ['required', 'string', 'max:20', 'unique:roles,name,' . $role->id],
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $role_id = $param['id'];

        if (!empty($param['permission'])) {
            Permissions::where('role_id', $role_id)->delete();
            foreach ($param['permission'] as $key => $value) {
                $value['module'] = $key;
                $value['role_id'] = $role_id;
                Permissions::create($value);
            }
            // dd($param['permission']);
        } else {
            Permissions::where('role_id', $role_id)->delete();
        }
        if (!empty($param)) {

            $role = Role::find($param['id']);
            unset($param['id']);
            $isUpdated = $role->update($param);
            if ($isUpdated) {
                return Redirect::back()->with('success', 'Updated Successfully.!');
            } else {
                return Redirect::back()->with('error', 'Something Wrong happend.!');
            }
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
