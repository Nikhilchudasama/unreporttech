<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEditResource extends JsonResource
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
            'name' => $this->name,
            'mobile' => $this->mobile,
            'active' => $this->active?true:false,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->userBranch->name,
            'profile_img' => $this->getFirstMediaUrl('profile_img')?:asset('images/avatar.png'),
        ];
        return $data;
    }
}
