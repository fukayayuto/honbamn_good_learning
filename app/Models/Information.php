<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Information extends Model
{
    use HasFactory;


    public function getData()
    {
        $data = DB::table('information')->latest()->limit(6)->get();

        return $data;
    }

    //全項目選択
    public function getAllData()
    {
        $data = DB::table('information')->latest()->get();

        return $data;
    }

    //全項目選択
    public function getInfo($id)
    {
        $data = Information::where('id', '=', $id)->first();

        return $data;
    }

    //最新データ取得
    public function getLatestData($count)
    {
        $data = Information::where('display_flg', '=', 1)->latest()->limit($count)->get();

        return $data;
    }

    //優先データ取得
    public function getPriorityData()
    {
        $data = Information::where('display_flg', '=', 1)
        ->where('display_rank', '=', 2)->latest()->limit(6)->get();

        return $data;
    }
}
