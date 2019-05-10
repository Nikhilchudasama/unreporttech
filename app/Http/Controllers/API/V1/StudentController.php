<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\Student;
use App\FeeOffer;
use Carbon\Carbon;
use App\StudentLogInfo;
use Illuminate\Http\Request;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;

class StudentController extends ApiController
{
    /**
     * Student List
     *
     * @param int $offset
     * @param string $serach seacheable string
     * @return mixed|array
     **/
    public function studentList(Request $request)
    {
        if($this->checkHeader() == null){
                $studentList = Student::studentList(request()->user()->id, request()->input('offset'), request()->input('search'), request()->input('branch_id'), request()->input('academic_id'));
                return $this->respondApi('Student List', new StudentCollection($studentList));
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Student Create
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function createStudent(Request $request)
    {
        if($this->checkHeader() == null){
                $validate = Validator::make($request->all(), [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'middle_name' => 'required|string|max:255',
                    'mobile_no' => 'required|numeric|min:10',
                    'student_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                    'academic_year_id' => 'required|numeric',
                    'branch_id' => 'required|numeric'
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                if (request()->user()->is_admin) {
                    $offer = FeeOffer::where('user_id', request()->user()->id)->whereDate('start_date', '<=', Carbon::now()->format('Y-m-d'))->whereDate('end_date', '<=', Carbon::now()->format('Y-m-d'))->first();
                }else{
                    $offer = FeeOffer::where('user_id', request()->user()->user_id)->whereDate('start_date', '<=', Carbon::now()->format('Y-m-d'))->whereDate('end_date', '<=', Carbon::now()->format('Y-m-d'))->first();
                }
                if($offer){
                    $validatedData = request()->all();
                    $validatedData['user_id'] = request()->user()->id;
                    $validatedData['fee_offers_id'] = $offer->id;
                    $validatedData['total_fee'] = $offer->fee;
                    $validatedData['unpaid_fee'] = $offer->fee - (($offer->fee * $offer->discount)/100);
                    $validatedData['discount'] = $offer->discount;
                    unset($validatedData['student_image']);
                    unset($validatedData['academic_year_id']);
                    $student = Student::create($validatedData);
                    $student->addMediaFromRequest('student_image')->toMediaCollection('student_image');
                    $sadata = [
                        'student_id' => $student->id,
                        'academic_year_id' => request()->input('academic_year_id')
                    ];
                    StudentLogInfo::create($sadata);
                    return $this->respondApi('Student created');
                }
                else{
                    return $this->respondWithFailureApi('Offer not available at that time so contact admin', [], true, 200);
                }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Edit Student
     *
     * @param int $id Student Id
     * @return mixed|array
     **/
    public function editStudent(Request $request)
    {
        if($this->checkHeader() == null){
            $editStudent = Student::find(request()->input('id'));
            return $this->respondApi('Student edit', new StudentResource($editStudent));
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Student Updated
    *
    * @param  Illuminate\Http\Request
    * @return mixed|array
     **/
    public function updateStudent(Request $request)
    {
        if($this->checkHeader() == null){
            $validate = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'mobile_no' => 'required|numeric|min:10',
            ]);
            if ($validate->fails()) {
                $this->statusCode = 422;
                return $this->respondWithFailureApi('Validation Error', $validate->errors());
            }
            $validatedData = request()->all();
            unset($validatedData['student_image']);
            $student = Student::find(request()->input('id'));
            $student->update($validatedData);
            if (request()->has('student_image')) {
                $student->addMediaFromRequest('student_image')->toMediaCollection('student_image');
            }
            return $this->respondApi('Student updated');
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }
}
