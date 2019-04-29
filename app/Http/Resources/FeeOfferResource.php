<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeeOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'package_name' => $this->package_name,
            'start_date' =>  date('d-m-Y',strtotime($this->start_date)),
            'end_date' =>  date('d-m-Y', strtotime($this->end_date)),
            'fee' => $this->fee,
            'discount' => $this->discount,
            'status' =>  $this->status?true:false
        ];
    }
}
