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
    public function index(Request $request)
    {

        // // get all computers status = 1
        // $computers = Room::find('G-102')->computers;

        // return $computers;

        $computers = Computer::query()
            ->with(['status', 'room']);

        if ($request->input('room_id')) {
            $computers->where('room_id', $request->input('room_id'));
        }
        if ($request->input('status_id')) {
            $computers->where('status_id', $request->input('status_id'));
        }

        if ($request->input('keyword')) {
            $computers->where('name', 'like', "%" . $request->input('keyword') . "%");
        }
        $computers =  $computers
            ->paginate(20)
            ->withQueryString();

        $rooms = Room::query()
            ->select('room_id', 'name')
            ->orderBy('name')
            ->get();
        // staus
        $statuses = Status::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
        // return $computers;
        return Inertia::render('Computer/Index', [
            'rooms' => $rooms,
            'statuses' => $statuses,
            'computers' => $computers,
            'filters' => $request->all(
                'room_id',
                'status_id',
                'keyword'
            )
        ]);
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
        $validatedData = $request->validate([
            'computer_id' => 'nullable',
            'name' => 'required',
            'description' => 'nullable',
            'room_id' => 'required|exists:rooms,room_id',
            'status_id' => 'required|exists:status,id',
        ]);

        // dd($validatedData);
        // $request->computer_id
        if ($request->input('computer_id')) {
            $request->validate([
                'name' => 'unique:computers,name,' . $request->input('computer_id') . ',computer_id'
            ]);
            $computer = Computer::findOrFail($request->input('computer_id'));
            $computer->update($validatedData);
        } else {
            $request->validate([
                'name' => 'unique:computers,name'
            ]);
            Computer::create($validatedData);
        }

        return redirect()->route('computer.index');
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
            'statuses' => $statuses,
            'computer' => $computer
        ]);
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
