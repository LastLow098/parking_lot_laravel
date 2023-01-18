<?php

namespace App\Http\Controllers;

use App\Models\Autos;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    public function getAutoNoParkingByClient(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        return Autos::getNotParking($request->get('id'));
    }

    public function getAutoParking()
    {
        return Autos::getParking();
    }

    public function setAutoParking(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        Autos::setAutoParking($request->get('id'));
        return redirect()->route('parking');
    }

    public function insertAuto(Request $request)
    {
        if (!is_numeric($request->get("client_id"))) {
            throw new \Exception("Неправельный формат id клиента");
        }

        $request->validate([
            'brand' => 'required|min:3|max:20',
            'model' => 'required',
            'color' => 'required|min:3',
            'gosNumber' => 'integer|unique:mysql.autos',
        ]);

        Autos::insert(array_slice($request->all(), 1), $request->get("client_id"));
        return redirect()->route('edit', ['id' => $request->get("client_id")]);
    }

    public function editAuto(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        $request->validate([
            'brand' => 'required|min:3|max:20',
            'model' => 'required',
            'color' => 'required|min:3',
            'gosNumber' => 'integer|unique:mysql.autos,gosNumber, ' . $request->get('id')
        ]);

        Autos::edit(array_slice($request->all(), 1, 4), $request->get('id'));
        return redirect()->route('edit', ['id' => $request->get("client_id")]);
    }

    public function deleteAuto(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        Autos::remove($request->get('id'));
        return redirect()->route('edit', ['id' => $request->get("client_id")]);
    }
}
