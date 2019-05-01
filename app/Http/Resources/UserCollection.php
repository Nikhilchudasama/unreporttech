<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($users) {
            $data = [
                'id' => $users->id,
                'name' => $users->name,
                'mobile' => $users->mobile,
                'active' => $users->active?true:false,
                'branch_id' => $users->branch_id,
                'branch_name' => $users->userBranch->name,
                'profile_img' => $users->getFirstMediaUrl('profile_img')?:asset('images/avatar.png'),
            ];
            return $data;
        });
    }
}
