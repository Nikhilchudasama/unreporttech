<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' =>  date('d-m-Y',strtotime($this->start_date)),
            'end_date' =>  date('d-m-Y', strtotime($this->end_date)),
            'status' =>  $this->status?true:false
        ];
        return $data;
    }
}
