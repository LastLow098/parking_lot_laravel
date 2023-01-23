<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autos extends Model
{
    public static function getAllAutos(string $id)
    {
        try {
            Clients::getOne($id);

            return DB::table('autos')
                ->where('client_id', '=', $id)
                ->get();
        } catch (\Exception $exception) {
            throw new \Exception("Не удалось получить список машин", 0, $exception);
        }
    }


    public static function getOneAuto(string $id)
    {
        $auto = DB::table('autos')
            ->where('id', '=', $id)
            ->get();

        if (!count($auto)) {
            throw new \Exception("Машины с таким id не существует");
        }

        return $auto[0];
    }


    public static function getNotParking(string $id)
    {
        try {
            Clients::getOne($id);

            return DB::table('autos')
                ->select()
                ->where('client_id', '=', $id)
                ->where('isParking', '=', '0')
                ->get();
        } catch (\Exception $exception) {
            throw new \Exception("Не удалось получить список машин вне парковки", 0, $exception);
        }
    }


    public static function getParking()
    {
        return DB::table('autos')
            ->join('clients', 'clients.id', '=', 'autos.client_id')
            ->select(['autos.id as auto_id', 'autos.brand', 'autos.model', 'clients.id as client_id', 'clients.name as client_name'])
            ->where('autos.isParking', '=', '1')
            ->get();
    }


    public static function setAutoParking(string $id)
    {
        try {
            $elem = self::getOneAuto($id);
            $elem->isParking = !$elem->isParking;
            return self::edit(array_slice((array)$elem, 2), $elem->id);
        } catch (\Exception $exception) {
            throw new \Exception("Не удалось изменить статус машины", 0, $exception);
        }
    }


    public static function insert(array $array)
    {
        return DB::table('autos')
            ->insertGetId($array);
    }


    public static function remove(string $id)
    {
        try {
            self::getOneAuto($id);

            return DB::table('autos')
                ->delete($id);
        }catch (\Exception $exception) {
            throw new \Exception("Не удалось удалить машину", 0, $exception);
        }
    }


    public static function edit(array $elem, string $id)
    {
        try {
            self::getOneAuto($id);

            return DB::table('autos')
                ->where('id', $id)
                ->update($elem);
        }catch (\Exception $exception) {
            throw new \Exception("Не удалось изменить данные машины", 0, $exception);
        }

    }
}
