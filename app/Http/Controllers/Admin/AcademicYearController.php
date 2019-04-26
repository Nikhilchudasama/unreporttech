<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\AcademicYear;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = 'Academic Year';
        return view('admin.academic_year.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.academic_year.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = request()->validate(AcademicYear::validationRules());
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
        $academicYear = AcademicYear::create($validatedData);
        return $this->respond('Record added',$academicYear);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $query = AcademicYear::query();
        $query->where('user_id', Auth::user()->id);
        return DataTables::of($query)
        ->addColumn('action', function ($academicYear) {
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.academicYear.edit', ['academicYear' => $academicYear->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>';   
            //$html .= '<a href="javascript:void(0)" data-url="' . route('admin.academicYear.destroy', ['academicYear' => $academicYear->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>';
            return $html;
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic_year.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $validatedData = request()->validate(AcademicYear::validationRules());
        $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
        $academicYear->update($validatedData);
        return $this->respond('Record updated',$academicYear);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear)
    {
        //
    }
}
