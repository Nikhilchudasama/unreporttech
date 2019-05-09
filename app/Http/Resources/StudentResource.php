<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'mobile_no' => $this->mobile_no,
            'student_image' => $this->getFirstMediaUrl('student_image'),
            'total_fee' => $this->total_fee,
            'unpaid_fee' => $this->unpaid_fee,
            'discount' => $this->discount
        ];
    }
}
