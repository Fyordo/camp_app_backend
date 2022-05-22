<?php

namespace App\Http\Resources;

use App\Http\Requests\OperationRequest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  OperationRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller' => new UserResource(User::where('id',  $this->seller_id)->first()),
            'buyer' => new UserResource(User::where('id',  $this->buyer_id)->first()),
            'sum' => $this->sum,
            'buyed_at' => $this->created_at
        ];
    }
}
