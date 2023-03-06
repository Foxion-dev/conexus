<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends BaseController
{
    public function index()
    {
        $sources = Source::all();
        return view('source.index', compact('sources'));
    }

    public function create()
    {
        $sources = Source::all();

        return view('source.create', compact('sources'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
        ]);

        Source::firstOrCreate(['title' => $data['title']], $data);
        return redirect()->route('source.create');
    }

    public function show(Source $source)
    {
        return view('source.show', compact('source'));
    }

    public function edit(Source $source)
    {
        return view('source.edit');
    }

    public function update(Source $source)
    {

        $data = request()->validate([
            'title' => 'required|string',
        ]);

        $source->update($data);

        return redirect()->route('source.create');

    }

    public function delete(Source $source)
    {
        $source->delete();
        return redirect()->route('source.create');
    }

    public function destroy(Source $source)
    {
        $source->delete();
        return redirect()->route('source.create');
    }

    public function restore()
    {

        $source = Source::withTrashed()->find(2);
        $source->restore();

//        dd('restored');
    }
}
