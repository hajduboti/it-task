<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Flightcase;
use App\Http\Resources\Flightcase as FlightcaseResource;



class FlightcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get flightcases
        $flightcases = Flightcase::paginate(5);

        // Return collection of flightcases as a resource 
        return FlightcaseResource::collection($flightcases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $flightcase = $request->isMethod('put') ? Flightcase::findOrFail
        ($request->casenumber) : new Flightcase;

        $flightcase->departuredate = $request -> input('departuredate');
        $flightcase->flightnumber = $request -> input('flightnumber');
        $flightcase->bookingnumber = $request -> input('bookingnumber');
        $flightcase->issue = $request -> input('issue');

        if($flightcase->save()){
            return new FlightcaseResource($flightcase);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get a flightcase
        $flightcase = Flightcase::findOrFail($id);
        return new FlightcaseResource($flightcase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flightcase = Flightcase::findOrFail($id);
        
        if($flightcase->delete()){
            return new FlightcaseResource($flightcase);
        }        
    }


}
