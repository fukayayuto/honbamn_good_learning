<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class InfoController extends Controller
{
    public function detail($id)
    {
        return view('/info/detail');
    }
}
