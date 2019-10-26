<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'passengers';
    public $timestamps = false;


    public function flightcase(){
        return $this->belongsTo(Flightcase::class);
    }
}
