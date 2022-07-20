<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    public static function getAll() {
        $data = DB::table('clients')
            ->leftJoin('autos', 'clients.id', '=', 'autos.client_id')
            ->groupBy('clients.id', 'clients.name')
            ->select(array('clients.id', 'clients.name', DB::raw('COUNT(autos.id) as count')))
            ->get();

        return $data;
    }

    public static function getClients() {
        return DB::table('clients')->select()->get();
    }

    public static function getOne(string $id) {
        return DB::table('clients')
            ->where('id', '=', $id)
            ->get();
    }

    public static function insert(array $array) {
        return DB::table('clients')
            ->insertGetId($array);
    }

    public static function remove(string $id) {
        return DB::table('clients')
            ->delete($id);
    }

    public static function edit(array $elem, string $id) {
        return DB::table('clients')
            ->where('id', $id)
            ->update($elem);
    }
}
