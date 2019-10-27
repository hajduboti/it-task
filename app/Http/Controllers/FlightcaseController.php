<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Flightcase;
use App\Http\Resources\Flightcase as FlightcaseResource;



class FlightcaseController extends Controller
{

    public function index()
    {
        // Get flightcases
        $flightcases = Flightcase::paginate(5);

        // Return collection of flightcases as a resource 
        return FlightcaseResource::collection($flightcases);

        //Return passengers for each flightcase
        foreach($flightcases as $flightcase){
            echo $flightcase;
        }
    }

 
    public function store(Request $request)
    {
        //Update flightcase if exists
        $flightcase = $request->isMethod('put') ? Flightcase::findOrFail
        ($request->casenumber) : new Flightcase;
        $flightcase->casenumber = $request ->input('casenumber');
        $flightcase->departuredate = $request -> input('departuredate');
        $flightcase->flightnumber = $request -> input('flightnumber');
        $flightcase->bookingnumber = $request -> input('bookingnumber');
        $flightcase->issue = $request -> input('issue');

        //Add flightcase
        if($flightcase->save()){
            return new FlightcaseResource($flightcase);
        }
    }

    public function show($id)
    {
        // Get a flightcase
        $flightcase = Flightcase::findOrFail($id);
        return new FlightcaseResource($flightcase);
    }


    public function destroy($id)
    {
        //Delete a flightcase
        $flightcase = Flightcase::findOrFail($id);
        if($flightcase->delete()){
            return new FlightcaseResource($flightcase);
        }        
    }

}
