<?php

namespace App\Http\Resources;

use App\Http\Requests\ChildRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  ChildRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource(User::where('id',  $this->user_id)->first()),
            'parent' => new UserResource(User::where('id',  $this->parent_id)->first()),
            'points' => $this->points,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}
