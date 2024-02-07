<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatusController extends Controller
{

    public function index()
    {
        $status = Status::query()
            ->orderBy('name')
            ->get();

        return Inertia::render('Status/Index', [
            'status' => $status
        ]);
    }

    public function edit($id)
    {
        return Status::findOrFail($id);
    }


    public function store(Request $request, $id = null)
    {
        $validatedData =   $request->validate([
            'name' => [
                'required',
                'unique:status,name,' . $id,
            ],
            'description' => 'nullable'
        ]);

        if ($id) {
            $status = Status::find($id);
            $status->update($validatedData);
        } else {
            $request->validate([
                'name' => 'required|unique:status'
            ]);
            Status::create($validatedData);
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        // find status first
        // and delete
        Status::findOrFail($id)->delete();
        return redirect()->back();
    }
}
