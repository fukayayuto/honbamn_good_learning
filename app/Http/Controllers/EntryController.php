<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationSetting;

class EntryController extends Controller
{
    public function delete($id)
    {
        $entry = new Entry();
        if (is_numeric($id)) {
            Entry::where('id', '=', $id)->update([
                'del_flg' => 1,
            ]);
        }

        return redirect()->route('home');
    }
}
