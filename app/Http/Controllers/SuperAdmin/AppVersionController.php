<?php

namespace App\Http\Controllers\SuperAdmin;

use App\AppversionSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AppVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = "AppVersion";
        return view('super_admin.appversion.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppversionSetting  $appversionSetting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = AppversionSetting::query();
        return DataTables::of($query)

        ->addColumn('action', function ($appversion) {
            $html = '';
                $html .= '<a href="javascript:void(0)" data-url="'.route('super_admin.appversion.edit', ['appversion' => $appversion->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppversionSetting  $appversionSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AppversionSetting $appversion)
    {
        return view('super_admin.appversion.edit', compact('appversion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppversionSetting  $appversionSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppversionSetting $appversion)
    {
        $validateData = request()->all();
        unset($validateData['_token']);
        $appversion->update($validateData);
        return $this->respond('Record updated',$appversion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppversionSetting  $appversionSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppversionSetting $appversionSetting)
    {
        //
    }
}
