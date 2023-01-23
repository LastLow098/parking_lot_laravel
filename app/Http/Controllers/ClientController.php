<?php

namespace App\Http\Controllers;

use App\Models\Autos;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getInfoClients(string $id)
    {
        return (object)[
            'client' => Clients::getOne($id),
            'autos' => Autos::getAllAutos($id)
        ];
    }

    public function getByClient(Request $request)
    {
        $id = $request->get('id');
        if (!is_numeric($id)) {
            throw new \Exception("Неправильный формат id");
        }

        $info_client = $this->getInfoClients($id);
        return view('edit', ['data' => $info_client]);
    }


    public function getClients()
    {
        return Clients::getClients();
    }

    public function insertClientWithAuto(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:100',
            'sex' => 'required',
            'phone' => 'required|min:12|max:13|unique:mysql.clients',
            'address' => 'required|min:15|max:500',
            'brand' => 'required|min:3|max:20',
            'model' => 'required',
            'color' => 'required|min:3',
            'gosNumber' => 'integer|unique:mysql.autos',
        ]);

        $request_arr = $request->all();
        Clients::insertWithAuto(array_slice($request_arr, 1, 4), array_slice($request_arr, 5));
        return redirect()->route('home');
    }

    public function editClient(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        $request->validate([
            'name' => 'required|min:4|max:100',
            'sex' => 'required',
            'phone' => 'required|min:12|max:13|unique:mysql.clients,phone, ' . $request->get('id'),
            'address' => 'required|min:15|max:500'
        ]);

        Clients::edit(array_slice($request->all(), 2, 4), $request->get('id'));
        return redirect()->route('edit', ['id' => $request->get("id")]);
    }

    public function deleteClient(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        Clients::remove($request->get('id'));
        return redirect()->route('home', ['data' => Clients::getAll()]);
    }
}
