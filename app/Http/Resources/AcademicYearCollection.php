<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AcademicYearCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($ayList) {
            $data = [
                'id' => $ayList->id,
                'title' => $ayList->title,
                'start_date' =>  date('d-m-Y',strtotime($ayList->start_date)),
                'end_date' =>  date('d-m-Y', strtotime($ayList->end_date)),
                'status' =>  $ayList->status?true:false
            ];
            return $data;
        });
    }
}
