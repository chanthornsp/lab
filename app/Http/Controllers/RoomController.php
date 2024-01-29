<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return inertia('Room/Index', [
            'rooms' => $rooms
        ]);
    }


    public function create()
    {
        return inertia('Room/Create');
    }

    public function edit(string $id)
    {
        return Room::query()
            ->where('room_id', $id)
            ->firstOrFail();

        // if (!$room) {
        //     abort(404);
        // }

        // return $room;
    }

    public function store(Request $request, $id = null)
    {
        // Http Request docs
        // https://laravel.com/docs/10.x/requests#input


        // https://laravel.com/docs/10.x/validation
        $request->validate([
            'name' => 'required|unique:rooms,name',
            'description' => 'nullable',
            'capacity' => 'required|integer',
            'status' => 'required|in:active,maintenance',
        ]);

        $roomId = $request->input('name');
        // https://laravel.com/docs/10.x/eloquent#inserting-and-updating-models
        Room::create([
            'room_id' => $roomId,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'status' => $request->input('status'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|unique:rooms,name,' . $id . ',room_id',
            'description' => 'nullable',
            'capacity' => 'required|integer',
            'status' => 'required|in:active,maintenance',
        ]);

        // 1. get room from database by id

        $room = Room::findOrFail($id);


        // 2. update room
        $room->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'status' => $request->input('status'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('room.index');
    }


    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->back();
    }
}
