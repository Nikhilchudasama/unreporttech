<?php

namespace App\Http\Controllers\API\V1;

use App\Student;
use App\StudentFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    /**
     * Student Fee Details
     *
     *
     * @param int $student_id
     * @return mixed|array
     **/
    public function feeDetails(Request $request)
    {
        if($this->checkHeader() == null){
            $feeRecords = StudentFee::where('student_id', request()->student_id)->get();
            return $this->respondApi('Student edit', $feeRecords);
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }

    }

    /**
     * Student Fee Add
     *
     * @param int $fee Fee
     * @param int $student_id StudentId
     * @return type
     * @throws conditon
     **/
    public function feeAdd(Request $request)
    {
        if($this->checkHeader() == null){
            $findStudent = Student::find(request()->student_id);
            $feeData = [
                'student_id' => request()->student_id,
                'paid' => request()->paid,
                'unpaid' => $findStudent->unpaid_fee - request()->paid
            ];
            StudentFee::create($feeData);
            $findStudent->unpaid_fee = ($findStudent->unpaid_fee - request()->paid);
            $findStudent->save();
            return $this->respondApi('Student Fee Add');
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }
}
