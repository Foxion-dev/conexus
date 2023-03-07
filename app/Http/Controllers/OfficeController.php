<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends BaseController
{
    public function index()
    {
        return false;
    }

    public function create()
    {
        $offices = Office::all();

        return view('office.create', compact('offices'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string',
        ]);

        Office::firstOrCreate(['name' => $data['name']], $data);
        return redirect()->back();
    }

    public function show(Office $office)
    {
        return false;
    }

    public function edit(Office $office)
    {
        return false;

    }

    public function update(Office $office)
    {
        return false;
    }

    public function delete(Office $office)
    {
        return false;
    }

    public function destroy(Office $office)
    {
        return false;
    }

    public function restore()
    {
        return false;
    }
}
