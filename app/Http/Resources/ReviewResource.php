<?php

namespace App\Http\Resources;

use App\Http\Requests\EventRequest;
use App\Models\EventModel;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  EventRequest  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller' => new EventResource(EventModel::where('id',  $this->event_id)->first()),
            'text' => $this->text,
        ];
    }
}
