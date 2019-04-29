<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Branch;
use App\Student;
use App\StudentLogInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = 'Student';
        return view('admin.student.index', compact('name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->is_admin) {
            $branches = Branch::where('user_id', Auth::user()->id)->get();
        }else{
            $branches = Branch::where('user_id', Auth::user()->user_id)->get();
        }
        return view('admin.student.add', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->is_admin && Auth::user()->setting->academic_year_id == null){
            return $this->respondWithFailure('Select Academic Year In Setting', [], true, 200);
        }
        if(!Auth::user()->is_admin && Auth::user()->checkAY() == null){
            return $this->respondWithFailure('Contact Admin and Select Academic Year', [], true, 200);
        }
        $validatedData = request()->validate(Student::validationRules());
        $validatedData['user_id'] = Auth::user()->id;
        unset($validatedData['student_image']);
        $student = Student::create($validatedData);
        $slInfo = [
            'student_id' => $student->id,
            'academic_year_id' => Auth::user()->checkAY()->academic_year_id,
            ];
        StudentLogInfo::create($slInfo);
        $student->addMediaFromRequest('student_image')->toMediaCollection('student_image');
        return $this->respond('Record added',$student);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $query = Student::query();
        $query->where('user_id', Auth::user()->id);
        return DataTables::of($query)
        ->addColumn('fullname', function($student){
            return $student->getFullName();
        })
        ->addColumn('image', function ($student) {
            return asset($student->getFirstMedia('student_image')->getFullUrl());
        })
        ->addColumn('action', function ($student) {
            $html = '';
            $html .= '<a href="javascript:void(0)" data-url="'.route('admin.student.edit', ['student' => $student->id]) .'" class="btn waves-effect waves-light btn-warning btn-icon edit-form-button"><i class="icofont icofont-pen-alt-4"></i></a>';
            //$html .= '<a href="javascript:void(0)" data-url="' . route('admin.student.destroy', ['student' => $student->id]) . '" class="btn waves-effect waves-light btn-danger btn-icon delete-button"><i class="icofont icofont-trash"></i></a>';
            return $html;
        })
        ->filterColumn('fullname', function($query, $keyword) {
            $query->orWhere('first_name', 'like', '%'. $keyword . '%');
            $query->orWhere('last_name', 'like', '%'. $keyword . '%');
            $query->orWhere('middle_name', 'like', '%'. $keyword . '%');
        })
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $branches = Branch::where('user_id', Auth::user()->id)->get();
        return view('admin.student.edit', compact('student', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = request()->validate(Student::validationRules($student->id));
        $student->update($validatedData);
        if (request()->has('student_image')) {
            $student->addMediaFromRequest('student_image')->toMediaCollection('student_image');
        }
        return $this->respond('Record updated',$student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
