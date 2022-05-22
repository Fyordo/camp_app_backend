<?php

namespace App\Http\Resources;

use App\Http\Requests\SanitaryRequest;
use App\Models\ChildModel;
use App\Models\StaffModel;
use Illuminate\Http\Resources\Json\JsonResource;

class SanitaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  SanitaryRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'child' => new ChildResource(ChildModel::where('id',  $this->child_user_id)->first()),
            'medic' => new StaffResource(StaffModel::where('id',  $this->medic_user_id)->first()),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
