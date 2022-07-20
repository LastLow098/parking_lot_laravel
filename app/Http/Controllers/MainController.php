<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clients;
use App\Models\Autos;

class MainController extends Controller {
    public function home() {
        return view('home', ['data' => Clients::getAll()]);
    }

    public function edit() {
        return view('edit');
    }

    public function parking() {
        return view('parking');
    }

    public function error() {
        return view('error');
    }

    public function getInfoClients(string $id) {
        return (object) [
            'client' => Clients::getOne($id)[0],
            'autos' => Autos::getAllAutos($id)
        ];
    }

    public function getByClient(Request $request) {
        $id = $request->get('id');
        if (is_numeric($id)) {
            return view('edit', ['data' => $this->getInfoClients($id)]);
        }
        return redirect()->route('error');
    }

    public function getClients(Request $request) {
        return Clients::getClients();
    }

    public function getAutoParking(Request $request) {
        if (is_numeric($request->get('id'))) {
            return Autos::getNotParking($request->get('id'));
        }
        return redirect()->route('error');
    }

    public function insertClientWithAuto(Request $request) {

        $valid = $request->validate([
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
        $client_id = Clients::insert(array_slice($request_arr, 1, 4));
        if ($client_id) {
            if (Autos::insert(array_slice($request_arr, 5), $client_id)) {
                return redirect()->route('home');
            }
        }

        return redirect()->route('error');
    }

    public function deleteClient(Request $request) {
        if (Clients::remove($request->get('id'))) {
            return redirect()->route('home', ['data' => Clients::getAll()]);
        }

        return redirect()->route('error');
    }

    public function deleteAuto(Request $request) {
        if (Autos::remove($request->get('id'))) {
            return redirect()->route('edit', ['id' => $request->get("client_id")]);
        }

        return redirect()->route('error');
    }

    public function insertAuto(Request $request)
    {
        $valid = $request->validate([
            'brand' => 'required|min:3|max:20',
            'model' => 'required',
            'color' => 'required|min:3',
            'gosNumber' => 'integer|unique:mysql.autos',
        ]);

        if (Autos::insert(array_slice($request->all(), 1), $request->get("client_id"))) {
            return redirect()->route('edit', ['id' => $request->get("client_id")]);
        }

        return redirect()->route('error');
    }

    public function editClient(Request $request) {
        $valid = $request->validate([
            'name' => 'required|min:4|max:100',
            'sex' => 'required',
            'phone' => 'required|min:12|max:13|unique:mysql.clients,phone, ' . $request->get('id'),
            'address' => 'required|min:15|max:500'
        ]);

        if (Clients::edit(array_slice($request->all(), 1, 4), $request->get('id'))) {
            return redirect()->route('edit', ['id' => $request->get("id")]);
        }

        return redirect()->route('error');
    }

    public function editAuto(Request $request) {
        $valid = $request->validate([
            'brand' => 'required|min:3|max:20',
            'model' => 'required',
            'color' => 'required|min:3',
            'gosNumber' => 'integer|unique:mysql.autos,gosNumber, ' . $request->get('id')
        ]);

        if (Autos::edit(array_slice($request->all(), 1, 4), $request->get('id'))) {
            return redirect()->route('edit', ['id' => $request->get("client_id")]);
        }

        return redirect()->route('error');
    }

    public function review() {
        echo json_encode(Clients::getAll());
    }
}
