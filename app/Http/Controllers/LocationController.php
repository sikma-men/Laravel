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
        $title = "Add Location"; // Variabel yang ingin Anda kirim
        return view('map/add-location', ['title' => $title]);
    }

    public function viewMap()
    {
        $title = "View Location"; // Variabel yang ingin Anda kirim
        return view('map/view-location', ['title' => $title]);
    }


    public function edit($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return redirect()->back()->with('error', 'Lokasi tidak ditemukan.');
        }
        $title = "Edit Location"; // Tambahkan variabel title
        return view('map.edit-location', compact('location', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $location = Location::findOrFail($id); // Pastikan ID valid
        $location->update([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'category' => $request->category,
        ]);

        return redirect()->route('edit-location', $id)->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function index()
    {

        return response()->json(Location::all());
    }
    public function destroy($id)
    {
        $location = Location::find($id);
        if (!$location) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $location->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
