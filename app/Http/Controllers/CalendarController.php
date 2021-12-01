<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Calendar\CalendarView;
use App\Models\CalendarView;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function show()
    {

        // $data = [
        //     [
        //         'title' => '美容院',
        //         'description' => '人気の美容室予約取れた',
        //         'start' => '2021-09-10',
        //         'end'   => '2021-09-10',
        //     ],
        //     ];

        

        return view('calendar');
           


        // return ;
        
        // $calendar = new CalendarView(time());

        // return view('calendar', [
        // 	"calendar" => $calendar
        // ]);
    }

    public function showCalendar(Request $request, $month)
    {
        $calendar = calendar($section, $patient, $month);
        $month = new CarbonImmutable($month);

        return view('calendar', compact('calendar', 'month'));
    }
}
