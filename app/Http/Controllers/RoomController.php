<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::take(10)->get();

        return $rooms;
    }


    public function create()
    {
        return inertia('Room/Create');
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
            'user_id' => 1,
        ]);

        return redirect()->back();
    }
}
