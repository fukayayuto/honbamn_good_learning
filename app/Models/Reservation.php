<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['count', 'reservation_date'];



    public function getData()
    {
        $data = DB::table($this->table)->get();

        return $data;
    }
}
