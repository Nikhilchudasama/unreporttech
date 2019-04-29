<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BranchCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($branch) {
            $data = [
                'id' => $branch->id,
                'name' => $branch->name,
                'address' =>  $branch->address?:''
            ];
            return $data;
        });
    }
}
