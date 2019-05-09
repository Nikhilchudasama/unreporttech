<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($student) {
            $data = [
                'id' => $student->id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'middle_name' => $student->middle_name,
                'mobile_no' => $student->mobile_no,
                'student_image' => $student->getFirstMediaUrl('student_image'),
                'total_fee' => $student->total_fee,
                'unpaid_fee' => $student->unpaid_fee,
                'discount' => $student->discount
            ];
            return $data;
        });
    }
}
