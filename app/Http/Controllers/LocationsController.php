<?php

namespace App\Http\Controllers;

use App\Location;
use App\Forecast;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $forecast_data = Forecast::where('location_id', $location->id)->get();
        return view('location.show', compact('location', 'forecast_data'));
    }

}
