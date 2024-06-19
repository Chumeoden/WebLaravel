<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function create()
    {
        $hotels = Hotel::all();
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_count' => 'required|integer|min:1',
            'room_types' => 'required|string', // Tạm thời chỉ yêu cầu string
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->name = $validatedData['name'];
        $hotel->address = $validatedData['address'];
        $hotel->room_count = $validatedData['room_count'];
        $hotel->room_types = json_encode(explode(', ', $validatedData['room_types']));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $hotel->image = $imagePath;
        }

        $hotel->save();

        return redirect()->route('hotels.show', $hotel->id)->with('success', 'Hotel updated successfully!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_count' => 'required|integer|min:1',
            'room_types' => 'required|string', // Tạm thời chỉ yêu cầu string
        ]);

        $hotel = new Hotel();
        $hotel->name = $validatedData['name'];
        $hotel->address = $validatedData['address'];
        $hotel->room_count = $validatedData['room_count'];
        $hotel->room_types = json_encode(explode(', ', $validatedData['room_types']));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $hotel->image = $imagePath;
        }

        $hotel->save();

        return redirect()->route('hotels.create')->with('success', 'Hotel created successfully!');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully!');
    }
}
