<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\AcademicYear;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Resources\AcademicYearResource;
use App\Http\Resources\AcademicYearCollection;

class AcademicYearController extends ApiController
{
    /**
     * Academic year List
     *
     * @param int $offset
     * @param string $serach seacheable string
     * @return mixed|array
     **/
    public function academicYearList(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $academicList = AcademicYear::ayList(request()->user()->id, request()->input('offset'), request()->input('search'));
            }else{
                $academicList = AcademicYear::ayList(request()->user()->user_id, request()->input('offset'), request()->input('search'));
            }
            return $this->respondApi('Academic Year', new AcademicYearCollection($academicList));
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Academic Year Create
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function createAY(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'title' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
                $validatedData['user_id'] = request()->user()->id;
                AcademicYear::create($validatedData);
                return $this->respondApi('Academic year created');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Academic Year Edit
     *
     * @param int $id Academic Year Id
     * @return mixed|array
     **/
    public function editAY(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $editAY = AcademicYear::find(request()->input('id'));
                return $this->respondApi('Academic year Edit', new AcademicYearResource($editAY));
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Branch Updated
    *
    * @param  Illuminate\Http\Request
    * @return mixed|array
     **/
    public function updateAY(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'title' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                unset($validatedData['id']);
                $user = AcademicYear::where('id', request()->input('id'))->update($validatedData);
                return $this->respondApi('Academic year updated');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }
}
