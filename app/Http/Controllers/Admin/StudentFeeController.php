<?php

namespace App\Http\Controllers\Admin;

use App\StudentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;

class StudentFeeController extends Controller
{

    /**
     * Get Student Fee History
     *
     *
     * @param int $student_id
     * @return \Illuminate\Http\Response
     **/
    public function getStudentFeeRecord($student_id)
    {
        $name = 'Student';
        $feeRecords = StudentFee::where('student_id', $student_id)->get();
        return view('admin.studentFee.index', compact('feeRecords', 'student_id', 'name'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($student_id)
    {
        $name = 'Student';
        return view('admin.studentFee.add',  compact('student_id','name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $findStudent = Student::find(request()->student_id);
        $feeData = [
            'student_id' => request()->student_id,
            'paid' => request()->paid,
            'unpaid' => $findStudent->unpaid_fee - request()->paid
        ];
        StudentFee::create($feeData);
        $findStudent->unpaid_fee = ($findStudent->unpaid_fee - request()->paid);
        $findStudent->save();
        return redirect()->route('admin.getFeeHistory', ['student_id' => request()->student_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function show(StudentFee $studentFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentFee $studentFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentFee $studentFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentFee  $studentFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentFee $studentFee)
    {
        //
    }
}
