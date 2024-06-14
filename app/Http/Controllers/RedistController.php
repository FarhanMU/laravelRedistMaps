<?php

namespace App\Http\Controllers;

use App\Models\redist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class RedistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    public function searchLocation(Request $request)
    {
        $address = $request->address;
        $key = 'address_' . md5($address);

        // Check if the location is cached in Redis
        $cachedLocation = Redis::get($key);
        if ($cachedLocation) {
            $location = json_decode($cachedLocation, true);
        } else {
            // If not cached, fetch from Google Maps
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => env('GOOGLE_MAPS_API_KEY')
            ]);

            if ($response->json()['status'] === 'OK') {
                $location = $response->json()['results'][0]['geometry']['location'];
                // Store the location in Redis as a JSON string
                Redis::set($key, json_encode($location));
            } else {
                return response()->json(['status' => $response->json()['status']]);
            }
        }

        return response()->json([
            'status' => 'OK',
            'lat' => $location['lat'],
            'lng' => $location['lng']
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(redist $redist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(redist $redist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, redist $redist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(redist $redist)
    {
        //
    }
}
