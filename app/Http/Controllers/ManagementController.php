<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationSetting;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\User;
use App\Models\Information;
use App\Models\Entry;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function index()
    {
        return view('/management/index');
    }

    public function reservation_index(Request $request)
    {
        $reservation = new ReservationSetting();

        if (!empty($request->search)) {
            $search = [];

            if (!empty($request->start_date) && isset($request->place)) {
                $search['start_date'] = $request->input('start_date');
                $search['place'] = $request->input('place');
                $reservation_data = $reservation->serachReservation($search);

                $data = [];
                foreach ($reservation_data as $k =>$val) {
                    $tmp = [];
                    $tmp['id'] = $val->id;
                    $tmp['place'] = $val->place;
                    $tmp['start_date'] = $val->start_date;
                    $tmp['progress'] = $val->progress;
                    $tmp['count'] = $val->count;
                    $tmp['created_at'] = $val->created_at;
                    $tmp['updated_at'] = $val->updated_at;

                    $start_date = new Carbon($tmp["start_date"]);
                    $progress = (int) $tmp["progress"];
                    $tmp["end_date"] = $start_date->addDays($progress)->format('Y-m-d');
        
                    $entry = new Entry();
                    $entry_data = $entry->getEntry($val->id);
                    $count = 0;
        
                    foreach ($entry_data as $item) {
                        $count = $count + $item->count;
                    }
                    $tmp['left_seat'] = $val->count - $count;
        
                    $data[$k] = $tmp;
                }


                return view('/management/reservation/index', compact('data', 'search'));
            }

            if (isset($request->place)) {
                $search['place'] = $request->input('place');
                $reservation_data = $reservation->serachReservation($search);

                $data = [];
                foreach ($reservation_data as $k =>$val) {
                    $tmp = [];
                    $tmp['id'] = $val->id;
                    $tmp['place'] = $val->place;
                    $tmp['start_date'] = $val->start_date;
                    $tmp['progress'] = $val->progress;
                    $tmp['count'] = $val->count;
                    $tmp['created_at'] = $val->created_at;
                    $tmp['updated_at'] = $val->updated_at;

                    $start_date = new Carbon($tmp["start_date"]);
                    $progress = (int) $tmp["progress"];
                    $tmp["end_date"] = $start_date->addDays($progress)->format('Y-m-d');
        
                    $entry = new Entry();
                    $entry_data = $entry->getEntry($val->id);
                    $count = 0;
        
                    foreach ($entry_data as $item) {
                        $count = $count + $item->count;
                    }
                    $tmp['left_seat'] = $val->count - $count;
        
                    $data[$k] = $tmp;
                }



                return view('/management/reservation/index', compact('data', 'search'));
            }

            if (!empty($request->start_date)) {
                $search['start_date'] = $request->input('start_date');
                $search['place'] = 0;
                $reservation_data = $reservation->serachReservation($search);

                $data = [];
                foreach ($reservation_data as $k =>$val) {
                    $tmp = [];
                    $tmp['id'] = $val->id;
                    $tmp['place'] = $val->place;
                    $tmp['start_date'] = $val->start_date;
                    $tmp['progress'] = $val->progress;
                    $tmp['count'] = $val->count;
                    $tmp['created_at'] = $val->created_at;
                    $tmp['updated_at'] = $val->updated_at;

                    $start_date = new Carbon($tmp["start_date"]);
                    $progress = (int) $tmp["progress"];
                    $tmp["end_date"] = $start_date->addDays($progress)->format('Y-m-d');
        
                    $entry = new Entry();
                    $entry_data = $entry->getEntry($val->id);
                    $count = 0;
        
                    foreach ($entry_data as $item) {
                        $count = $count + $item->count;
                    }
                    $tmp['left_seat'] = $val->count - $count;
        
                    $data[$k] = $tmp;
                }

                return view('/management/reservation/index', compact('data', 'search'));
            }
        }

        $reservation_data = $reservation->getAllData();

        $data = [];
        foreach ($reservation_data as $k =>$val) {
            $tmp = [];
            $tmp['id'] = $val->id;
            $tmp['place'] = $val->place;
            $tmp['start_date'] = $val->start_date;
            $tmp['progress'] = $val->progress;
            $tmp['count'] = $val->count;
            $tmp['created_at'] = $val->created_at;
            $tmp['updated_at'] = $val->updated_at;

            $start_date = new Carbon($tmp["start_date"]);
            $progress = (int) $tmp["progress"];
            $tmp["end_date"] = $start_date->addDays($progress)->format('Y-m-d');

            $entry = new Entry();
            $entry_data = $entry->getEntry($val->id);
            $count = 0;

            foreach ($entry_data as $item) {
                $count = $count + $item->count;
            }
            $tmp['left_seat'] = $val->count - $count;

            $data[$k] = $tmp;
        }
    
        return view('/management/reservation/index', compact('data'));
    }


    public function reservation_store(Request $request)
    {
        $reservation = new ReservationSetting();

        $reservation->place = $request->place;
        $reservation->start_date = $request->start_date;
        $reservation->progress = $request->progress;
        $reservation->count = $request->count;

        $reservation->save();
        return redirect('/management/reservation/index');
    }

    public function reservation_detail($id)
    {
        $reservation = new ReservationSetting();

        $data = $reservation->getFind($id);

        return view('/management/reservation/detail', compact('data'));
    }

    public function reservation_detail_edit(Request $request)
    {
        $reservation = new ReservationSetting();

        $id = $request->id;
        $start_date = $request->start_date;
        $place = $request->place;
        $progress = $request->progress;
        $count = $request->count;

        ReservationSetting::where('id', '=', $id)->update([
            'start_date' => $start_date,
            'progress' => $progress,
            'place' => $place,
            'count' => $count,
        ]);

        return redirect('/management/reservation/index');
    }

    public function reservation_entry_list($id)
    {
        $reservation = new ReservationSetting();
        $reservation = $reservation->selectReservation($id);

        $reservation_data = [];
        $reservation_data['id'] = $reservation->id;
        $reservation_data['start_date'] = $reservation->start_date;
        $reservation_data['count'] = $reservation->count;
        $reservation_data['place'] = $reservation->place;
        $reservation_data['progress'] = $reservation->progress;

        $start_date = new Carbon($reservation_data["start_date"]);
        $progress = (int) $reservation_data["progress"];
        $reservation_data["end_date"] = $start_date->addDays($progress)->format('Y-m-d');
        $reservation_data['created_at'] = $reservation->created_at;



        $entry = new Entry();
        $entry_data = $entry->getEntry($id);

        if (empty($entry_data)) {
            return view('/management/reservation/list', compact('reservation_data'));
        }

        $data = [];
        $count = 0;

        foreach ($entry_data as $val) {
            $tmp = [];
            $tmp['id'] = $val->id;
            $tmp['count'] = $val->count;
            $count = $count + $val->count;
            $tmp['user_flg'] = 0;
            $tmp['created_at'] = $val->created_at;


            if ($val->user_flg == 1) {
                $user = new User();
                $user_data = $user->selectUser($val->user_id);
                $tmp['user_id'] = $user_data->id;
                $tmp['family_name'] = $user_data->family_name;
                $tmp['first_name'] = $user_data->first_name;
                $tmp['email'] = $user_data->email;
                $tmp['company_name'] = $user_data->company_name;
                $tmp['phone'] = $user_data->phone;
                $tmp['user_flg'] = 1;
                if (!empty($user_data->sales_office)) {
                    $tmp['sales_office'] = $user_data->sales_office;
                }
            } else {
                $account = new Account();
                $account_data = $account->getAccount($val->account_id);
                $tmp['user_id'] = $account_data->id;
                $tmp['family_name'] = $account_data->family_name;
                $tmp['first_name'] = $account_data->first_name;
                $tmp['email'] = $account_data->email;
                $tmp['company_name'] = $account_data->company_name;
                $tmp['phone'] = $account_data->phone;
                if (!empty($account_data->sales_office)) {
                    $tmp['sales_office'] = $account_data->sales_office;
                }
            }

            $data[$val->id] = $tmp;
        }

        $reservation_data['used_seat'] = $reservation_data['count'] - $count;


        return view('/management/reservation/list', compact('data', 'reservation_data'));
    }




    public function information_index()
    {
        $information = new Information();
        $information_data = $information->getAllData();
        $data = [];
        foreach ($information_data as $k => $val){
            $tmp = [];
            $tmp['id'] = $val->id;
            $tmp['link'] = $val->link;
            $tmp['title'] = $val->title;
            $tmp['link_part'] = $val->link_part;
            $tmp['display_flg'] = $val->display_flg;
            $tmp['created_at'] = $val->created_at;
            $tmp['updated_at'] = $val->updated_at;
            $data[$k] = $tmp;

        }
        return view('/management/information/index', compact('data'));
    }

    public function information_detail($id)
    {
        $information = new Information();
        $data = $information->getInfo($id);
        return view('/management/information/detail', compact('data'));
    }

    public function information_store(Request $request)
    {
        $information = new Information();

        $information->link = $request->link;
        $information->title = $request->title;
        $information->link_part = $request->link_part;

        $information->save();

        return redirect('/management/information/index');
    }

    public function information_detail_edit(Request $request)
    {
        $information = new Information();
        $id = $request->id;
        $link = $request->link;
        $title = $request->title;
        $link_part = $request->link_part;
        if(isset($request->display_flg)){
            $display_flg= $request->display_flg;
        }else{
            $display_flg= 0;
        }

        Information::where('id', '=', $id)->update([
            'link' => $link,
            'title' => $title,
            'link_part' => $link_part,
            'display_flg' => $display_flg,
        ]);

        return redirect('/management/information/index');
    }


    public function information_delete(Request $request, $id)
    {
        $del_flg = $request->input('del_flg');
        if (empty($del_flg)) {
            return redirect('/management/information/index');
        }
        $reservation = new Information();

        Information::find($id)->delete();

        return redirect('/management/information/index');
    }

    public function information_delete_index(Request $request, $id)
    {
        return redirect('/management/information/index');
    }

    public function user_index()
    {
        $user = new User();
        $user_data = $user->getAllData();

        $account = new Account();
        $account_data = $account->getAllData();

        return view('/management/user/index', compact('user_data', 'account_data'));
    }

    public function user_detail($id, $user_flg)
    {
        if ($user_flg == 1) {
            $user = new User();
            $data = $user->selectUser($id);

            $entry = new Entry();
            $entry_data = $entry->getUserEntry($id);

        } else {
            $account = new Account();
            $data = $account->getAccount($id);

            $entry = new Entry();
            $entry_datas = $entry->getAccountEntry($id);

            $entry_data = [];

            foreach ($entry_data as $val){
                $reservation = new ReservationSetting();
                $reservation_data = $reservation->selectReservation($val['id']);
                
            }


        }
        return view('/management/user/detail', compact('data'));
    }
}
