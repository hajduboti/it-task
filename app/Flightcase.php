<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flightcase extends Model
{
    //Specifying the non-default primary key for the table
    protected $primaryKey = 'casenumber';
    
    //Disabling the auto-increment
    public $incrementing = false;
    protected $table = 'flightcases';
    public $timestamps = false;


    // Defining the many-to-one Flightcase-Passenger relationship
    public function passengers(){
                return $this->hasMany(Passenger::class, 'casenumber');
    }
}
