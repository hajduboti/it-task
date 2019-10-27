<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Passenger extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Default resource
        return parent::toArray($request);
    }
}
