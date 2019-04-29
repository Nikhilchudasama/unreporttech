<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchCollection;

class BranchController extends ApiController
{

    /**
     * Branch List
     *
     * @param int $offset
     * @param string $serach seacheable string
     * @return mixed|array
     **/
    public function searchBranchList(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $branchList = Branch::branchList(request()->user()->id, request()->input('offset'), request()->input('search'));
                return $this->respondApi('branch', new BranchCollection($branchList));
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

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
     * Branch Edit
     *
     * @param int $id Branch Id
     * @return mixed|array
     **/
    public function editBranch(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $editBranch = Branch::find(request()->input('id'));
                return $this->respondApi('Branch edit', new BranchResource($editBranch));
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
                unset($validatedData['id']);
                $user = Branch::where('id', request()->input('id'))->update($validatedData);
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
