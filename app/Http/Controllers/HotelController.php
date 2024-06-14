<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function create()
    {
        $hotels = Hotel::all(); // Lấy danh sách tất cả các khách sạn
        return view('hotels.create', compact('hotels'));
    }

    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Update hotel record in database
        $hotel = Hotel::findOrFail($id);
        $hotel->name = $validatedData['name'];
        $hotel->address = $validatedData['address'];
        $hotel->save();

        return redirect()->route('hotels.show', $hotel->id)->with('success', 'Hotel updated successfully!');
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Create hotel record in database
        $hotel = new Hotel();
        $hotel->name = $validatedData['name'];
        $hotel->address = $validatedData['address'];
        $hotel->save();

        return redirect()->route('hotels.create')->with('success', 'Hotel created successfully!');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotels.create')->with('success', 'Hotel deleted successfully!');
    }
}
