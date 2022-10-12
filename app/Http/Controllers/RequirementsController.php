<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\Location;
use DB;

class RequirementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Location::distinct('country')->orderBy('country')->pluck('country')->prepend('Please Select');
        return view('requirement.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requirement = new Requirement($request->all());

        $result = auth()->user()->requirement()->create([
            'location_id' => $request['location'],
            'wind_speed' => $request['wind_speed'],
            'cloud_cover' => $request['cloud_cover'],
            'days_ahead' => $request['days_ahead'],
            'min_hours' => $request['min_hours']
        ]);
        $location = Location::find($request['location']);
        if($location->lat == "") 
        {
            $url = "http://api.geonames.org/getJSON?username=dpoulson&geonameId=".$location->id;
					  $json = file_get_contents($url);
					  $raw = json_decode($json);
            $updated = DB::table('locations')
                        ->where('id', $location->id)
                        ->update([
                          'lat' => $raw->lat,
                          'lon' => $raw->lng,
                          'timezone' => $raw->timezone->timeZoneId
                        ]);

        }
        return redirect()->route('user.show', auth()->user()->id )
                        ->with('success','Requirement created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Requirement::destroy($id);
        return redirect()->route('user.show', auth()->user()->id )
                        ->with('success','Requirement deleted successfully.');
    }
    
    public function get_by_country(Request $request)
    {
        if (!$request->country) {
            $html = '<option value="">'.'Please Select'.'</option>';
        } else {
            $html = '';
            $subcountries = Location::distinct('subcountry')->where('country', $request->country)->orderBy('subcountry')->pluck('subcountry');
            foreach ($subcountries as $subcountry) {
                $html .= '<option value="'.$subcountry.'">'.$subcountry.'</option>';
            }
        }

        return ($html);
    }
    
    public function get_by_subcountry(Request $request)
    {
        if (!$request->subcountry) {
            $html = '<option value="">'.'Please Select'.'</option>';
        } else {
            $html = '';
            $locations = Location::where('subcountry', $request->subcountry)->orderBy('name')->get();
            //dd($locations);
            foreach ($locations as $location) {
                $html .= '<option value="'.$location->id.'">'.$location->name.'</option>';
            }
        }

        return ($html);
    }
}
