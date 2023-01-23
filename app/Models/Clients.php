<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    public static function getAll()
    {
        return DB::table('clients')
            ->leftJoin('autos', 'clients.id', '=', 'autos.client_id')
            ->groupBy('clients.id', 'clients.name')
            ->select(array('clients.id', 'clients.name', DB::raw('COUNT(autos.id) as count')))
            ->get();
    }


    public static function getClients()
    {
        return DB::table('clients')->select()->get();
    }


    public static function getOne(string $id)
    {
        $client = DB::table('clients')
            ->where('id', '=', $id)
            ->get();

        if (!count($client)) {
            throw new \Exception("Клиента с таким id не сужествует");
        }

        return $client[0];
    }


    public static function insert(array $array)
    {
        return DB::table('clients')->insertGetId($array);
    }

    public static function insertWithAuto(array $client, array $auto) {
        DB::transaction(function() use ($client, $auto) {
            $client_id = DB::table('clients')->insertGetId($client);

            $auto["client_id"] = $client_id;
            DB::table('autos')->insert($auto);
        });
    }


    public static function remove(string $id)
    {
        try {
            self::getOne($id);

            return DB::table('clients')
                ->delete($id);
        } catch (\Exception $exception) {
            throw new \Exception("Не удалось удалить клиента", 0, $exception);
        }
    }


    public static function edit(array $elem, string $id)
    {
        try {
            self::getOne($id);

            return DB::table('clients')
                ->where('id', $id)
                ->update($elem);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), 0, $exception);
        }

    }
}
