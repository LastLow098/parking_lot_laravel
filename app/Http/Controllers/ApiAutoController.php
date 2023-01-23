<?php

namespace App\Http\Controllers;

use App\Models\Autos;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ApiAutoController
{
    public function setAutoParking(Request $request): int
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        return Autos::setAutoParking($request->get('id'));
    }

    public function insertAuto(Request $request)
    {
        if (!is_numeric($request->get("client_id"))) {
            throw new \Exception("Неправельный формат id клиента");
        }

        try {
            $request->validate([
                'brand' => 'required|min:3|max:20',
                'model' => 'required',
                'color' => 'required|min:3',
                'gosNumber' => 'integer|unique:mysql.autos',
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 0, $exception);
        }

        return self::formatAnswer(['id' => Autos::insert($request->all())]);
    }

    public function editAuto(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        if (!is_numeric($request->get('client_id'))) {
            throw new \Exception("Неправельный формат id клиента");
        }

        $id = $request->get('id');
        $args = $request->all();
        unset($args['id']);

        return Autos::edit($args, $id);
    }

    public function deleteAuto(Request $request)
    {
        if (!is_numeric($request->get('id'))) {
            throw new \Exception("Неправельный формат id");
        }

        return Autos::remove($request->get('id'));
    }


    private function formatAnswer($data)
    {
        return json_encode(is_array($data) ? ["status" => "success"] + $data : ["data" => $data, "status" => "success"], JSON_UNESCAPED_UNICODE);
    }
}
