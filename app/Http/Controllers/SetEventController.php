<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\ReservationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\User;
use App\Models\Entry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailTest;
use Carbon\Carbon;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SetEventController extends Controller
{
    //カレンダー情報リアルタイム取得
    public function setEvents_entry(Request $request)
    {
 
         //予約情報一覧取得
        $reservation = new ReservationSetting();
 
        $data = $reservation->selectDef();
 
 
 
        //予約状況を取得
        $entry = new Entry();
 
        $empty_seat = [];
 
        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }
 
 
 
        //表示期間
        $start = $this->formatDate($request->all()['start']);
        $end = $this->formatDate($request->all()['end']);
 
        //データ取得
        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->whereBetween('place', [1, 2])->get();
 
        //データを配列にまとめる
        $newArr = [];
 
        foreach ($events as $item) {
            $count = 0;
            foreach ($empty_seat as $k => $seat) {
                if ($item["id"] == $k) {
                    $count = $seat;
                }
            }
 
 
            $newItem["id"] = $item["id"];
            // $newItem["title"] = '残り'.$count.'人';
            $newItem["start"] = $item["start_date"];
 
            if ($item["place"] == 1) {
                $newItem["title"] = '会員用：残り' . $count . '人';
                $newItem["color"] = '#99CCFF';
            } elseif ($item["place"] == 2) {
                $newItem["title"] = '非会員用：残り' . $count . '人';
                $newItem["color"] = '#CCCCCC';
            } elseif ($item["place"] == 3) {
                $newItem["color"] = 'green';
            } else {
            }
 
            $newItem["url"] = 'http://localhost:8888/reservation/entry/index/' . $item["id"];
 
 
            $newItem["textColor"] = 'black';
 
            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する
 
        echo json_encode($newArr);
    }

    //カレンダー情報全表示
    public function setEventsAll(Request $request)
    {
  
          //予約情報一覧取得
        $reservation = new ReservationSetting();
  
        $data = $reservation->getData();
  
        //予約状況を取得
        $entry = new Entry();
  
        // $empty_seat = [];
  
        // foreach ($data as $val) {
        //     $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        // }
        //表示期間
        // $start = $this->formatDate($request->start);
        // $end = $this->formatDate($request->end);



        $start = '2020-01-01';
        $end = '2025-12-31';
  
        //データ取得
        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->get();
  
        //データを配列にまとめる
        $newArr = [];
  
        foreach ($events as $item) {
            $entry = new Entry();
            $left_seat = $entry->getEmptySeat($item['id'], 5);

            $newItem["id"] = $item["id"];
            // $newItem["title"] = '残り'.$count.'人';
            $newItem["start"] = $item["start_date"];
  
            if ($item["place"] == 1) {
                $newItem["title"] = '('.$left_seat.'/5)' .'[ユーザー限定]グッドラーニング！初任運転者講習（受講開始日で予約、最長７日間まで受講可能）';
                $newItem["color"] = '#66CC33';
            } elseif ($item["place"] == 2) {
                $newItem["title"] = '('.$left_seat.'/5)' .'グッドラーニング！初任運転者講習（受講開始日で予約、最長７日間まで受講可能)';
                $newItem["color"] = '#FF9999';
            } elseif ($item["place"] == 11) {
                $newItem["title"] = '('.$left_seat.'/5)' .'【三重県トラック協会】グッドラーニング！初任運転者講習（受講開始日で予約、最長５日間まで受講可能）';
                $newItem["color"] = '#CC99FF';
            } elseif ($item["place"] == 21) {
                $newItem["title"] = '('.$left_seat.'/5)' .'【京都府トラック協会】グッドラーニング！初任運転者講習（受講開始日で予約、最長５日間まで受講可能)';
                $newItem["color"] = '#FFFF66';
            } else {
            }
  
            $newItem["url"] = 'http://localhost:8888/management/reservation/list/' . $item["id"];

            $newItem["contentHeight"] = 'auto';
            
  
  
            $newItem["textColor"] = 'black';
  
            // $start_date = new Carbon($item["start_date"]);
            // $progress = (int) $item["progress"];
            // $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する
  
        echo json_encode($newArr);
    }
}
