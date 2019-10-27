<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Passenger as PassengerResource;

class Flightcase extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'casenumber'=> $this->casenumber,
            'departuredate'=> $this->departuredate,
            'flightnumber'=> $this->flightnumber,
            'bookingnumber'=> $this->bookingnumber,
            'issue'=> $this->issue,
            'passengers' => PassengerResource::collection($this->passengers),
        ];
    }

}
