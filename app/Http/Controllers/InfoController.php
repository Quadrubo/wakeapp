<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Http\Requests\StoreInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use NominatimLaravel\Content\Nominatim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::all()->map(function ($info) {
            return $info;
        });

        return Inertia::render('Infos/Index', [
            'infos' => $infos
        ]);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Infos/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = new Info;
        $info->eta = $request->eta;
        $info->time_to_get_up = $request->time_to_get_up;

        $nominatim = new Nominatim(config('nominatim.url'));

        $search = $nominatim->newSearch();
        $search->query($request->residence);
        
        $result = $nominatim->find($search)[0];

        $info->residence_longitude = $result["lon"];
        $info->residence_latitude = $result["lat"];

        $search = $nominatim->newSearch();
        $search->query($request->destination);
        
        $result = $nominatim->find($search)[0];

        $info->destination_longitude = $result["lon"];
        $info->destination_latitude = $result["lat"];
        $info->transport_type = $request->transport_type;

        $info->user_id = Auth::user()->id;

        $info->save();

        return redirect()->route('infos.index')->with('success', 'Infos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        $url = 'https://api.openrouteservice.org/v2/matrix/' . $info->transport_type;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>"{
            \"locations\": [
                [
                    $info->residence_longitude,
                    $info->residence_latitude
                ],
                [
                    $info->destination_longitude,
                    $info->destination_latitude
                ]
            ]
        }",
        CURLOPT_HTTPHEADER => array(
            'Authorization: 5b3ce3597851110001cf6248799d675d181345a995a4a51ce213648d',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $info->time_needed = json_decode($response, true)["durations"][0][1];

        $arrival_time = Carbon::make($info->eta)->subMinutes(5);
        $start_time = Carbon::make($info->eta)->subMinutes(5)->subseconds($info->time_needed);
        $wake_time = Carbon::make($info->eta)->subMinutes(5)->subseconds($info->time_needed)->subMinutes($info->time_to_get_up);

        $info["arrival_time"] = $arrival_time->format("H:i:s");
        $info["start_time"] = $start_time->format("H:i:s");
        $info["wake_time"] = $wake_time->format("H:i:s");

        return Inertia::render('Infos/Show', [
            'info' => $info
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInfoRequest  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, Info $info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $info->delete();

        return back()->with('message', 'Info Delete Successfully');
    }
}
