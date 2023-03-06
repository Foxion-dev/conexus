<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Source;
use Illuminate\Http\Request;

class ClientController extends BaseController
{
    public function index()
    {
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }

    public function create()
    {
        $sources = Source::all();
        return view('client.create', compact('sources'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'source_id' => '',
            'comment' => '',
            'person_photo' => '',
            'person_documents' => '',
        ]);

        if(isset($data['person_photo'])){
            $data['person_photo'] = str_replace('public/', '', $data['person_photo']->store('/public/upload/client'));
        }
        if(isset($data['person_documents'])){
            $data['person_documents'] = str_replace('public/', '', $data['person_documents']->store('/public/upload/client'));
        }

        $client = Client::create($data);

        return redirect()->route('index');
    }

    public function show(Client $client)
    {
        return view('client.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $sources = Source::all();
        return view('client.edit', compact('client', 'sources'));
    }

    public function update(Client $client)
    {

        $data = request()->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'source_id' => '',
            'comment' => '',
            'person_photo' => '',
            'person_documents' => '',
        ]);

        if(isset($data['person_photo'])){
            $data['person_photo'] = str_replace('public/', '', $data['person_photo']->store('/public/upload/client'));
        }
        if(isset($data['person_documents'])){
            $data['person_documents'] = str_replace('public/', '', $data['person_documents']->store('/public/upload/client'));
        }

        $client->update($data);

        return redirect()->route('client.index');

    }

    public function delete(Client $client)
    {

        $client->delete();

        return redirect()->route('index');
    }

    public function destroy(Client $client)
    {

        $client->delete();

        return redirect()->route('index');
    }

    public function restore()
    {

        $client = Client::withTrashed()->find(2);
        $client->restore();

//        dd('restored');
    }

}
