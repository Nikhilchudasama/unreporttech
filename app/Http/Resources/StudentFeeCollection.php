<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentFeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($feeRecords) {
            $data = [
                'id' => $feeRecords->id,
                'student_id' => $feeRecords->student_id,
                'paid' => $feeRecords->paid,
                'unpaid' => $feeRecords->unpaid,
                'created_at' => date('d-m-Y', strtotime($feeRecords->created_at)),
            ];
            return $data;
        });
    }
}
