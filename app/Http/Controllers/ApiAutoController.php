<?php

namespace App\Http\Controllers;

use App\Models\Autos;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ApiAutoController
{
    public function getAutoNoParkingByClient($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Неправельный формат id", 400);
        }

        return response()->json(Autos::getNotParking($id));
    }

    public function setAutoParking($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Неправельный формат id", 400);
        }

        return response()->json(Autos::setAutoParking($id));
    }

    public function insertAuto(Request $request)
    {
        if (!is_numeric($request->get("client_id"))) {
            throw new \Exception("Неправельный формат id клиента", 400);
        }

        try {
            $request->validate([
                'brand' => 'required|min:3|max:20',
                'model' => 'required',
                'color' => 'required|min:3',
                'gosNumber' => 'integer|unique:mysql.autos',
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 400, $exception);
        }

        return response()->json(['id' => Autos::insert($request->all())], 201);
    }

    public function editAuto(Request $request, $id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Неправельный формат id", 400);
        }

        if (!is_numeric($request->get('client_id'))) {
            throw new \Exception("Неправельный формат id клиента", 400);
        }

        return response()->json(Autos::edit($request->all(), $id));
    }

    public function deleteAuto($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("Неправельный формат id", 400);
        }

        return response()->json(Autos::remove($id));
    }
}
