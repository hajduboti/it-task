<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Passenger;
use App\Http\Resources\Passenger as PassengerResource;


class PassengerController extends Controller
{

    public function index()
    {
        // Get flightcases
        $passengers = Passenger::paginate(15);

        // Return collection of flightcases as a resource 
        return PassengerResource::collection($passengers);
    }

    public function store(Request $request)
    {
        //
        $passenger = $request->isMethod('put') ? Passenger::findOrFail
        ($request->id) : new Passenger;

        $passenger->casenumber = $request -> input('casenumber');
        $passenger->firstname = $request -> input('firstname');
        $passenger->lastname = $request -> input('lastname');
        $passenger->email = $request -> input('email');
        $passenger->phone = $request -> input('phone');

        if($passenger->save()){
            return new PassengerResource($passenger);
        }
    }

    public function show($id)
    {
        // Get a flightcase
        $passenger = Passenger::findOrFail($id);
        return new PassengerResource($passenger);
    }

    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        
        if($passenger->delete()){
            return new PassengerResource($passenger);
        }        
    }
}
