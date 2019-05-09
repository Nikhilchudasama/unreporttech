<?php

namespace App\Http\Controllers\API\V1;

use Validator;
use App\FeeOffer;
use App\CommonFunctions;
use Illuminate\Http\Request;
use App\Http\Resources\FeeOfferResource;
use App\Http\Resources\FeeOfferCollection;

class FeeOfferController extends ApiController
{
    /**
     * Fee Offer List
     *
     * @param int $offset
     * @param string $serach seacheable string
     * @return mixed|array
     **/
    public function foList(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $foList = FeeOffer::foList(request()->user()->id, request()->input('offset'), request()->input('search'));
            }else{
                $foList = FeeOffer::foList(request()->user()->user_id, request()->input('offset'), request()->input('search'));
            }
            return $this->respondApi('Fee Offer', new FeeOfferCollection($foList));
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Fee Offer Create
     *
     * @param  Illuminate\Http\Request
     * @return mixed|array
     **/
    public function createFO(Request $request)
    {
        if($this->checkHeader() == null){
            $offer = FeeOffer::whereDate('start_date','<=', Carbon::now()->format('Y-m-d'))->whereDate('end_date','<=', Carbon::now()->format('Y-m-d'))->first();
            if($offer == null)
            {
                if (request()->user()->is_admin) {
                    $validate = Validator::make($request->all(), [
                    'package_name' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'fee' => 'required|numeric',
                    'discount' => 'required',
                ]);
                    if ($validate->fails()) {
                        $this->statusCode = 422;
                        return $this->respondWithFailureApi('Validation Error', $validate->errors());
                    }
                    $validatedData = request()->all();
                    $validatedData['status'] = CommonFunctions::checkedCheckbox(request()->input('status'));
                    $validatedData['user_id'] = request()->user()->id;
                    FeeOffer::create($validatedData);
                    return $this->respondApi('Fee offer created');
                } else {
                    $this->statusCode= 403;
                    return $this->respondWithFailureApi('Forbidden');
                }
            }else{
                $this->statusCode= 422;
                return $this->respondWithFailureApi('Already This Date Offer');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Fee Offer Edit
     *
     * @param int $id Fee Offer Id
     * @return mixed|array
     **/
    public function editFO(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $editFO = FeeOffer::find(request()->input('id'));
                return $this->respondApi('Fee offer Edit', new FeeOfferResource($editFO));
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }

    /**
     * Fee Offer Updated
    *
    * @param  Illuminate\Http\Request
    * @return mixed|array
     **/
    public function updateFO(Request $request)
    {
        if($this->checkHeader() == null){
            if(request()->user()->is_admin){
                $validate = Validator::make($request->all(), [
                    'package_name' => 'required|string|max:255',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'fee' => 'required|numeric',
                    'discount' => 'required',
                ]);
                if ($validate->fails()) {
                    $this->statusCode = 422;
                    return $this->respondWithFailureApi('Validation Error', $validate->errors());
                }
                $validatedData = request()->all();
                unset($validatedData['id']);
                $user = FeeOffer::where('id', request()->input('id'))->update($validatedData);
                return $this->respondApi('Fee offer updated');
            }else{
                $this->statusCode= 403;
                return $this->respondWithFailureApi('Forbidden');
            }
        }else{
            return $this->respondWithFailureApi($this->checkHeader(), [], false, 401);
        }
    }
}
