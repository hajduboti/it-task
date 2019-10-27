<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'passengers';
    public $timestamps = false;

    // The inverse of the many-to-one Flightcase-Passenger relationship
    public function flightcase(){
        return $this->belongsTo(Flightcase::class, 'casenumber');
    }
}
