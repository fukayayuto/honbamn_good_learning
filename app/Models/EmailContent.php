<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailContent extends Model
{
    use HasFactory;

    //ユーザー個別の予約状況取得
    public function getContent($id)
    {
        $data = EmailContent::where('id', '=', $id)->first();

        return $data;
    }
}
