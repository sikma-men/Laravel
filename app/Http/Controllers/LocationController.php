<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Pastikan ini ada
use Illuminate\Support\Facades\Log;


class LocationController extends Controller
{
    public function storeLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string',
            'name' => 'required|string'
        ]);

        $location = new Location();
        $location->name = $request->name;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->category = $request->category;
        $location->save();

        return redirect()->route('add-location')->with('success', 'Location added successfully!');
    }

    public function getLocations(Request $request)
    {
        $category = $request->query('category');
        $location = DB::table('locations')
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->get();

        return response()->json($location);
    }



    public function addLocationForm()
    {
        return view('map/add-location');
    }

    public function viewMap()
    {
        return view('map/view-location');
    }
}
