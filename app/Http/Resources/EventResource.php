<?php

namespace App\Http\Resources;

use App\Http\Requests\EventRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'beginning' => $this->beginning,
            'ending' => $this->ending,
        ];
    }
}
