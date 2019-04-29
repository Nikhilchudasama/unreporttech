<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeeOfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($foList) {
            $data = [
                'id' => $foList->id,
                'package_name' => $foList->package_name,
                'start_date' =>  date('d-m-Y',strtotime($foList->start_date)),
                'end_date' =>  date('d-m-Y', strtotime($foList->end_date)),
                'fee' => $foList->fee,
                'discount' => $foList->discount,
                'status' =>  $foList->status?true:false
            ];
            return $data;
        });
    }
}
