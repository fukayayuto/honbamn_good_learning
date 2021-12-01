<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    //空席状況確認
    public function getEmpty($id)
    {
        $data = Entry::where('reservation_id', '=', $id)->get();

        $count = 5;

        foreach ($data as $val) {
            $count = $count - $val['count'];
        }


        return $count;
    }

    //ユーザー個別の予約状況取得
    public function userSelectEntry($id)
    {
        $data = Entry::where('user_id', '=', $id)->get();

        return $data;
    }

    //予約データ一件取得
    public function selectEntry($id)
    {
        $data = Entry::where('id', '=', $id)->first();

        return $data;
    }

    //予約に対してのエントリー収集
    public function getEntry($id)
    {
        $data = Entry::where('reservation_id', '=', $id)->get();

        return $data;
    }

     //非会員の予約を収集
     public function getAccountEntry($account_id)
     {
         $data = Entry::where('account_id', '=', $account_id)->get();
 
         return $data;
     }

     //会員の予約を収集
     public function getUserEntry($user_id)
     {
         $data = Entry::where('user_id', '=', $user_id)->get();
 
         return $data;
     }
}
