<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flightcase extends Model
{
    protected $primaryKey = 'casenumber';
    protected $table = 'flightcases';
    public $timestamps = false;


    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
