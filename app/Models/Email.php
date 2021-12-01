<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    use HasFactory;

    public function getData()
    {
        $data = DB::table('emails')->latest()->get();

        return $data;
    }
}
