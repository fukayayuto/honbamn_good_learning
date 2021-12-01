<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\ReservationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Information;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        // $title = 'これはテストです';
        // $link_part = 'テスト';
        // $part_first = strstr($title,$link_part,true);
        // $left_part = strstr($title,$link_part);
        // $word_count = mb_strlen($link_part);
        // $part_final = mb_substr($left_part, $word_count);
        // die();

        //ログイン情報
        if (empty(Auth::user())) {
            return redirect('/login');
        }
        $user = Auth::user();

        //予約情報表示
        $entry = new Entry();
        $reservation = new ReservationSetting();
        $entry_data = $entry->userSelectEntry($user->id);

        $data = [];

        foreach ($entry_data as $k => $val) {
            $tmp = [];
            $reservation_data = $reservation->userSelectReservation($val['reservation_id']);
            $tmp['start_date'] = $reservation_data->start_date;
            $tmp['progress'] = $reservation_data->progress;
            $tmp['place'] = $reservation_data->place;
            $tmp['count'] = $val['count'];
            $tmp['entry_id'] = $val['id'];
            $data[$k] = $tmp;
        }


        //インフォメーション優先項目
        $information = new Information();
        $information_datas = $information->getPriorityData();


        $information_priority_data = [];
        $count = 6;

        foreach ($information_datas as $k => $val) {
            $tmp = [];
            $title = $val->title;
            $link_part = $val->link_part;
            $part_first = strstr($title, $link_part, true);
            $left_part = strstr($title, $link_part);
            $word_count = mb_strlen($link_part);
            $part_final = mb_substr($left_part, $word_count);
            $date = new Carbon($val->created_at);

            $tmp['title'] = $title;
            $tmp['link_part'] = $link_part;
            $tmp['link'] = $val->link;
            $tmp['part_first'] = $part_first;
            $tmp['part_final'] = $part_final;
            $tmp['created_at'] = $date->format('Y.m.d');
            $count = $count - 1;
            $information_priority_data[$k] = $tmp;
        }


        $information = new Information();
        $information_datas = $information->getLatestData($count);

        $information_data = [];

        foreach ($information_datas as $k => $val) {
            $tmp = [];
            $title = $val->title;
            $link_part = $val->link_part;
            $part_first = strstr($title, $link_part, true);
            $left_part = strstr($title, $link_part);
            $word_count = mb_strlen($link_part);
            $part_final = mb_substr($left_part, $word_count);
            $date = new Carbon($val->created_at);

            $tmp['title'] = $title;
            $tmp['link_part'] = $link_part;
            $tmp['link'] = $val->link;
            $tmp['part_first'] = $part_first;
            $tmp['part_final'] = $part_final;
            $tmp['created_at'] = $date->format('Y.m.d');
            $information_data[$k] = $tmp;
        }

        return view('/dashboard', compact('data', 'user', 'information_data', 'information_priority_data'));
    }

    public function reservation_detail($id)
    {
        $entry = new Entry();
        $data = $entry->selectEntry($id);

        $reservation = new ReservationSetting();
        $reservation_data = $reservation->userSelectReservation($data->reservation_id);
        $start_date = $reservation_data->start_date;
        $progress = (int) $reservation_data->progress;
        $s_date = new Carbon($start_date);
        $end_date= $s_date->addDays($progress)->format('Y-m-d');
        return view('/reservation/detail', compact('data'))->with('start_date', $start_date)->with('end_date', $end_date);
    }

    public function good_learning_about_cost()
    {
        $reservation = new ReservationSetting();
        $reservation_data = $reservation->getReservationData();

        $data =  [];
        foreach ($reservation_data as $k => $val) {
            $tmp = [];
            $tmp['id'] = $val->id;
            $weekday = ['日', '月', '火', '水', '木', '金', '土'];
            $progress = (int) $val->progress;
            $start_date = new Carbon($val->start_date);
            $tmp['start_week'] = $weekday[$start_date->dayOfWeek];
            $tmp['start_date'] = $start_date->format('m月d日');
            $tmp['end_date'] = $start_date->addDays($progress)->format('d日');
            $end_date = new Carbon($start_date->addDays($progress));
            $tmp['end_week'] = $weekday[$end_date->dayOfWeek];

            $reservation = new ReservationSetting();
            $reservation_data = $reservation->getReservationDataNomember($val->start_date);
            if (!empty($reservation_data)) {
                $entry = new Entry();
                $entry_data = $entry->getEntry($reservation_data->id);
                $count = 0;
        
                foreach ($entry_data as $item) {
                    $count = $count + $item->count;
                }
                $tmp['id_nomember'] = $reservation_data->id;
                $tmp['left_seat_nomember'] = $val->count - $count;
            }

            $entry = new Entry();
            $entry_data = $entry->getEntry($val->id);
            $count = 0;
        
            foreach ($entry_data as $item) {
                $count = $count + $item->count;
            }
            $tmp['left_seat'] = $val->count - $count;



            $today = Carbon::today();
            $next_month = $today->addmonth();

            $tmp['display_flg'] = 0;
            if ($start_date->between(Carbon::today(), $next_month)) {
                $tmp['display_flg'] = 1;
            }

            $data[$k] = $tmp;
        }



        return view('/good_learning/about_cost', compact('data'))->with('today', $today)->with('next_month', $next_month);
    }


    public function truck_index()
    {
        return view('/truck/index');
    }

    public function truck_price_index()
    {
        $reservation = new ReservationSetting();
        $reservation_data = $reservation->getReservationData();

        $data =  [];
        foreach ($reservation_data as $k => $val) {
            $tmp = [];
            $tmp['id'] = $val->id;
            $weekday = ['日', '月', '火', '水', '木', '金', '土'];
            $progress = (int) $val->progress;
            $start_date = new Carbon($val->start_date);
            $tmp['start_week'] = $weekday[$start_date->dayOfWeek];
            $tmp['start_date'] = $start_date->format('m月d日');
            $tmp['end_date'] = $start_date->addDays($progress)->format('d日');
            $end_date = new Carbon($start_date->addDays($progress));
            $tmp['end_week'] = $weekday[$end_date->dayOfWeek];

            $reservation = new ReservationSetting();
            $reservation_data = $reservation->getReservationDataNomember($val->start_date);
            if (!empty($reservation_data)) {
                $entry = new Entry();
                $entry_data = $entry->getEntry($reservation_data->id);
                $count = 0;
        
                foreach ($entry_data as $item) {
                    $count = $count + $item->count;
                }
                $tmp['id_nomember'] = $reservation_data->id;
                $tmp['left_seat_nomember'] = $val->count - $count;
            }

            $entry = new Entry();
            $entry_data = $entry->getEntry($val->id);
            $count = 0;
        
            foreach ($entry_data as $item) {
                $count = $count + $item->count;
            }
            $tmp['left_seat'] = $val->count - $count;



            $today = Carbon::today();
            $next_month = $today->addmonth();
            $start_date = new Carbon($val->start_date);

            $tmp['display_flg'] = 0;
            if ($start_date->between(Carbon::today(), $next_month)) {
                $tmp['display_flg'] = 1;
            }

            $data[$k] = $tmp;
        }

        return view('/truck/price', compact('data'))->with('today', $today)->with('next_month', $next_month);
    }

    public function truck_price2_index()
    {
        return view('/truck/price2');
    }
}
