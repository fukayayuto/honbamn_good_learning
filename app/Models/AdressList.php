<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdressList extends Model
{
    use HasFactory;

    public function getAccountList($id)
    {
        $data = AdressList::where('adress_id', '=', $id)->get();

        return $data;
    }
}
