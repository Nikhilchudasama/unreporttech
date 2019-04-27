<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends ApiController
{
    /**
     * Branch Create
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function createBranch(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'address' => 'required|string'
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                $validatedData['user_id'] = request()->user()->id;
                Branch::create($validatedData);
                return $this->respondApi('Branch created');
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
    public function updateBranch(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'address' => 'required|string'
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                unset($validatedData['bid']);
                $user = Branch::where('id', request()->input('bid'))->update($validatedData);
                return $this->respondApi('Branch updated');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }
}
