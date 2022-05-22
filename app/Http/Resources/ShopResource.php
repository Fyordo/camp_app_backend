<?php

namespace App\Http\Resources;

use App\Http\Requests\ShopRequest;
use App\Models\StaffModel;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  ShopRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller' => new StaffResource(StaffModel::where('id',  $this->medic_user_id)->first()),
            'title' => $this->title,
            'category' => $this->category,
        ];
    }
}
