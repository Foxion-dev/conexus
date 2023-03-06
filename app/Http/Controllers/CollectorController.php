<?php

namespace App\Http\Controllers;

use App\Models\Collector;

class CollectorController extends BaseController
{
    public function index()
    {
        $collectors = Collector::all();
        return view('collector.index', compact('collectors'));
    }

    public function create()
    {
        $collectors = Collector::all();

        return view('collector.create', compact('collectors'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string',
        ]);

        Collector::firstOrCreate(['name' => $data['name']], $data);
        return redirect()->route('collector.create');
    }

    public function show(Collector $collector)
    {
        return view('collector.show', compact('collector'));
    }

    public function edit(Collector $collector)
    {
        return view('collector.edit');
    }

    public function update(Collector $collector)
    {

        $data = request()->validate([
            'name' => 'required|string',
        ]);

        $collector->update($data);

        return redirect()->route('collector.create');

    }

    public function delete(Collector $collector)
    {
        $collector->delete();
        return redirect()->route('collector.create');
    }

    public function destroy(Collector $collector)
    {
        $collector->delete();
        return redirect()->route('collector.create');
    }

    public function restore()
    {

        $collector = Collector::withTrashed()->find(2);
        $collector->restore();

//        dd('restored');
    }
}
