<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Room;
use App\Models\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Computer/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // rooms
        $rooms = Room::query()
            ->select('room_id', 'name')
            ->orderBy('name')
            ->get();
        // staus
        $statuses = Status::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
        return Inertia::render('Computer/Create', [
            'rooms' => $rooms,
            'statuses' => $statuses
        ]);
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
    public function show(Computer $computer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Computer $computer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
