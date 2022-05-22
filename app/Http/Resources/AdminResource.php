<?php

namespace App\Http\Resources;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  AdminRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource(User::where('id',  $this->user_id)->first()),
        ];
    }
}
