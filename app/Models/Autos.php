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

    public static function insert(array $array, string $client_id) {
        $array["client_id"] = $client_id;
        return DB::table('autos')
            ->insert($array);
    }

    public static function remove(string $id) {
        return DB::table('autos')
            ->delete($id);
    }

    public static function edit(array $elem, string $id) {
        return DB::table('autos')
            ->where('id', $id)
            ->update($elem);
    }
}
