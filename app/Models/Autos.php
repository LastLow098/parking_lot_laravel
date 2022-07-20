<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Autos extends Model
{
    public static function getAllAutos(string $id) {
        return DB::table('autos')
            ->where('client_id', '=', $id)
            ->get();
    }

    public static function getOneAuto(string $id) {
        return DB::table('autos')
            ->where('id', '=', $id)
            ->get();
    }

    public static function insert(array $array, string $client_id) {
        $array["client_id"] = $client_id;
        return DB::table('autos')
            ->insert($array);
    }

    public static function remove(string $id) {
        return DB::table('autos')
            ->delete($id);
    }

    public static function getNotParking(string $id) {
        return DB::table('autos')
            ->select()
            ->where('client_id', '=', $id)
            ->where('isParking', '=', '0')
            ->get();
    }

    public static function setAutoParking(string $id) {
        $elem = self::getOneAuto($id)[0];
        $elem->isParking = !$elem->isParking;
        return self::edit(array_slice((array) $elem, 1), $elem->id);
    }

    public static function getParking() {
        return DB::table('autos')
            ->join('clients', 'clients.id', '=', 'autos.client_id')
            ->select(['autos.id as auto_id', 'autos.brand', 'autos.model', 'clients.id as client_id', 'clients.name as client_name'])
            ->where('autos.isParking', '=', '1')
            ->get();
    }

    public static function edit(array $elem, string $id) {
        return DB::table('autos')
            ->where('id', $id)
            ->update($elem);
    }
}
