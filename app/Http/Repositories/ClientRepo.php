<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ClientInterface;
use App\Models\Client;
use RealRashid\SweetAlert\Facades\Alert;

class ClientRepo implements ClientInterface
{
    public function index($request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        })->paginate(5);

        return view('admin.pages.client.index', compact('clients'));
    }

    public function store($request)
    {
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);
        Client::create($request_data);
        Alert::success('Create Success', 'Create Client Success');
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.pages.client.create');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.pages.client.edit', compact('client'));
    }

    public function update($client, $request)
    {
        $client->update($request->all());
        Alert::success('Update Success', 'Update Client Success');
        return redirect()->route('admin.client.index');
    }

    public function destroy($client, $request)
    {
        $client->delete();
        Alert::error('Delete Success', 'Delete Client Success');
        return redirect()->route('admin.client.index');
    }
}
