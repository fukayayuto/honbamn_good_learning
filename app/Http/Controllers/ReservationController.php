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

class ReservationController extends Controller
{
    public function index()
    {
        $data = DB::table('reservations')->get();

        //開始日
        $start = date("Y-m-d");
        //終了日
        $end = date("Y年m月d日", strtotime('+3 month'));


        $reservation = [];
        $reservation_date = [];
        for ($i = $start; $i <= $end; $i = date('Y-m-d', strtotime($i . '+1 day'))) {
            $reservation = DB::table('reservations')->where('reservation_date', $i)->get();

            $count = 5;

            if (!empty($reservation)) {
                foreach ($reservation as $res) {
                    $count -= $res->count;
                }
            }
            if ($count != 5) {
                $reservation_date[$i] = $count;
            }
        }

        var_dump($reservation_date);



        return view('reservation');
    }

    //予約日時決定後
    public function reservation_create(Request $request)
    {
        $reservation = new Reservation();

        //非会員用
        if (empty(Auth::user())) {
            $reservation->count = $request->count;
            $reservation->reservation_date = $request->reservation_date;
            // return view('account')compact('data');
            return view('account', compact('reservation'));
        }

        //会員用



        $user = Auth::user();

        $data = $request->all();




        return view('last_check', compact('data', 'user'));

        // return view('count');
    }

    public function select()
    {
        return view('count_form');
    }

    public function select0()
    {
        $flg = 1;
        return view('count_form')->with('flg', $flg);
    }

    //人数選択後、予約画面移行時
    public function next(Request $request)
    {
        $member = $request->count;

        $data = DB::table('reservations')->get();


        //開始日
        $start = date("Y-m-d");
        //終了日
        $end = date("Y年m月d日", strtotime('+3 month'));


        $reservation = [];
        $reservation_date = [];
        $data = [];
        $n = 0;
        for ($i = $start; $i <= $end; $i = date('Y-m-d', strtotime($i . '+1 day'))) {
            $reservation = DB::table('reservations')->where('reservation_date', $i)->get();

            $count = 5;


            if (!empty($reservation)) {
                foreach ($reservation as $res) {
                    $count -= $res->count;
                }
            }
            if ($count != 5) {
                // $reservation_date[$n] = $n = 0;;
                $data[$n]['date'] =  $i;
                $data[$n]['count'] = $count;
                $n++;
            }
        }

        $arr = count($data);

        // if(!empty($request->user_id)){
        //     $user_id = $request->user_id;

        //     return view('reservation')->with('count',$count)->with('user_id',$user_id);
        // }


        return view('reservation', compact('data'))->with('count', $member)->with('arr', $arr);
    }


    //会員チェック
    public function user_check(Request $request)
    {

        //会員状態の確認
        if (!empty(Auth::user())) {
            $user = Auth::user();

            return view('count_form')->with('user', $user);
        }

        return redirect()->route('login');
    }

    //アカウント情報登録
    public function reservation_check(Request $request)
    {

        //ポストデータすべての取得
        $data = $request->all();


        return view('last_check', compact('data'));
        // return view('last_check')->with('request', $request);
    }

    //予約情報登録
    public function reservation_register(Request $request)
    {
        $reservation = new Reservation();

        $account = new Account();

        //会員状態の確認
        // if (!empty(Auth::user())) {
        //     $user = Auth::user();
        // }

        $account->name = $request->name;
        $account->email = $request->email;
        $account->company_name = $request->company_name;
        if (!empty($request->sales_office)) {
            $account->sales_office = $request->sales_office;
        }
        $account->phone = $request->phone;

        //アカウント登録
        $account->save();

        $user = DB::table('accounts')->where('email', $request->email)->first();


        //予約情報登録
        $reservation->count = $request->count;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->user_id = $user->id;

        $reservation->save();

        $mail_text = 'メールテストで使いたい文章を記載';
        $mail_adress = $account->email;
        // $user_name = 'testoooo';
        $m_user_name = $user->name . $user->name;
        $m_company_name = $account->company_name;
        $m_reservation_date = $reservation->reservation_date;
        $m_reservation_count = $reservation->count;

        Mail::to($mail_adress)->send(new MailTest($mail_text, $m_user_name, $m_company_name, $m_reservation_date, $m_reservation_count));



        return redirect()->route('count');
    }


    public function home()
    {
        if (!empty(Auth::user())) {
            $user = Auth::user();

            return redirect('/dashboard');


            $user_id = 0;
            $user_id = $user->id;

            $reservation = DB::table('reservations')->where('user_id', 1)->get();

            $data = [];

            // dd($reservation);

            // for ($i=0;$i <= count($reservation);$i++) {
            //     $data[$i]['date'] = $reservation[$i]['reservation_date'];
            //     $data[$i]['count'] = $reservation[$i]['count'];
            // }



            // foreach ($reservation as $res) {
            //     $data['date'] = $res['reservation_date'];
            //     $data['count'] = $res['count'];
            // }

            return view('welcome', compact('reservation'));
        }

        return view('welcome');
    }

    public function setting_date_post()
    {
        return view('setting/date');
    }

    public function setting_date()
    {
        $reservation = new ReservationSetting();

        $data = $reservation->getData();

        return view('setting/date', compact('data'));
    }

    // public function setting_reservation_post($id)
    // {
    //     dd($id);
    //     return view('setting/date', compact('data'));
    // }

    public function setting_reservation($id)
    {
        $reservation = new ReservationSetting();

        $data = $reservation->getFind($id);


        return view('setting/detail', compact('data'));
    }

    //予約日時設定詳細変更
    public function setting_reservation_change(Request $request)
    {
        $reservation_id = $request->id;

        $reservation = new ReservationSetting();

        // $data = $request->all();
        $data = $request->only(['place', 'start_date', 'progress', 'count', 'id']);

        $reservation->updateOne($data);

        //予約詳細変更
        // $data->place = $request->place;
        // $data->start_date = $request->start_date;
        // $data->progress = $request->progress;
        // $data->count = $request->count;

        // $data->save();

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->getData();

        return view('setting/date', compact('data'));
    }

    //予定設定画面表示
    public function setting_reservation_add()
    {
        return view('setting/add_date');
    }

    //予定日時追記
    public function setting_reservation_add_post(Request $request)
    {
        $reservation = new ReservationSetting();
        $reservation->place = $request->place;
        $reservation->start_date = $request->start_date;
        $reservation->progress = $request->progress;
        $reservation->count = $request->count;

        $reservation->save();


        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->getData();

        return view('setting/date', compact('data'));
    }

    //予約顧客人数入力画面表示
    public function reservation_customer_select()
    {
        return view('/reservation/select_count');
    }

    //予約顧客人数入力画面決定
    public function reservation_customer_select_post(Request $request)
    {
        $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectDefalut();



        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }

        return view('/reservation/select_start_date', compact('data'), compact('empty_seat'))->with('count', $count);
    }

    //予約確認画面表示
    public function reservation_check_list($id, $count)
    {
        $user = [];

        if (!empty(Auth::user())) {
            $user = Auth::user();
        }

        $reservation = new ReservationSetting();

        $data = $reservation->find($id);



        return view('/reservation/check_list', compact('data'), compact('user'))->with('count', $count);
    }

    public function reservation_register_second(Request $request)
    {
        $data = $request->all();

        if (!empty(Auth::user())) {
            $user = Auth::user();
        }

        $account = new Account();

        $account->name = $user['name'];
        $account->email = $user['email'];
        $account->company_name = $user['company_name'];
        if (!empty($user['sales_office'])) {
            $account->sales_office = $user['sales_office'];
        }
        $account->phone = $user['phone'];
        $account->user_id = $user['id'];

        //アカウント登録
        $account->save();
        $account_id = $account->id;
        // var_dump($account_id);
        // die(('kk'));

        //予約情報取得
        $reservation_id = $data['reservation_id'];

        $entry = new Entry();

        $entry->reservation_id = $reservation_id;
        $entry->count = $data['count'];
        $entry->user_id = $account_id;
        $entry->save();



        return view('/reservation/finish');
    }

    //カレンダー情報リアルタイム取得
    public function setEvents(Request $request)
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

            $newItem["url"] = 'http://localhost:8888/reservation/index/' . $item["id"];


            $newItem["textColor"] = 'black';

            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }


    //カレンダー情報リアルタイム取得(三重県)
    public function setEventsMei(Request $request)
    {
        $reservation = new ReservationSetting();

        //デフォルトの２点のデータ取得
        $data = $reservation->selectMie();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }


        $start = $this->formatDate($request->all()['start']);

        $end = $this->formatDate($request->all()['end']);

        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->where('place', '=', 11)->get();

        $newArr = [];
        foreach ($events as $item) {
            $count = 0;
            foreach ($empty_seat as $k => $seat) {
                if ($item["id"] == $k) {
                    $count = $seat;
                }
            }
            $newItem["id"] = $item["id"];
            $newItem["title"] = '残り' . $count . '人';
            $newItem["start"] = $item["start_date"];

            $newItem["color"] = '#99CCFF';
            $newItem["textColor"] = 'black';

            // $newItem["url"] = 'http://localhost:8888/reservation/mie/index/'.$item["id"];


            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }

    //カレンダー情報リアルタイム取得(京都)
    public function setEventsKyoto(Request $request)
    {
        $reservation = new ReservationSetting();

        //デフォルトの２点のデータ取得
        $data = $reservation->selectkyoto();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }


        $start = $this->formatDate($request->all()['start']);

        $end = $this->formatDate($request->all()['end']);

        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->where('place', '=', 21)->get();

        $newArr = [];
        foreach ($events as $item) {
            $count = 0;
            foreach ($empty_seat as $k => $seat) {
                if ($item["id"] == $k) {
                    $count = $seat;
                }
            }
            $newItem["id"] = $item["id"];
            $newItem["title"] = '残り' . $count . '人';
            $newItem["start"] = $item["start_date"];

            $newItem["color"] = '#99CCFF';
            $newItem["textColor"] = 'black';

            $newItem["url"] = 'http://localhost:8888/reservation/kyoto/index/' . $item["id"];

            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }

    public function setEventsTest()
    {



        //座席数取得

        $count = 1;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        //デフォルトの２点のデータ取得
        $data = $reservation->selectMie();

        // var_dump($data);
        // die();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }



        $start = '2021-11-01';
        $end = '2021-11-31';

        // $start = $this->formatDate($request->all()['start']);

        // $end = $this->formatDate($request->all()['end']);

        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->where('place', '=', 11)->get();

        $newArr = [];
        foreach ($events as $item) {
            $newItem["id"] = $item["id"];
            $newItem["title"] = $item["place"];
            $newItem["start"] = $item["start_date"];

            $newItem["color"] = 'yellow';

            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }


    public function formatDate($date)
    {
        return str_replace('T00:00:00+09:00', '', $date);
    }

    public function reservation_customer_index_post($id)
    {
        die('iii');
        return view('/reservation/index');
    }

    public function reservation_customer_index()
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectDef();



        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }


        // if (!empty($id)) {
        //     $new_reservations = new ReservationSetting();
        //     $new_reservation = $new_reservations->selectReservation($id);
        // }




        return view('/reservation/index', compact('data', 'empty_seat', 'end_date'));
    }

    // カレンダーの予約をタップしたとき
    public function reservation_customer_index_add($id)
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectDef();



        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];

        // foreach ($data as $val) {
        //     $empty_seat[$val['id']] = $entry->getEmpty($val['id']);

        //     $start_date = new Carbon($val["start_date"]);
        //     $progress = (int) $val["progress"];
        //     $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        // }


        if (!empty($id)) {
            $new_reservations = new ReservationSetting();
            $new_reservation = $new_reservations->selectReservations($id);
            session(['id' => $id]);
        }

        foreach ($new_reservation as $val) {
            $empty_seat[$val['id']] = (int) $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }

        return view('/reservation/index', compact('data', 'empty_seat', 'end_date', 'new_reservation'));
    }

    //予約確認画面に移行したとき
    public function reservation_register_check(Request $request)
    {
        $reservation_id = $request->id;
        $count = $request->count1;
        $user_flg = $request->user_flg;

        if ($user_flg == 0) {
            return view('/reservation/nomember/account')->with('count', $count)->with('reservation_id', $reservation_id);
        }

        $user_flg = null;


        //ログイン情報
        if (empty(Auth::user())) {
            return view('/auth/login')->with('flg',true);
        }
        $user = Auth::user();


        //予約情報
        $reservation = new ReservationSetting();

        $data = $reservation->selectReservation($reservation_id);

        // $data = [];

        // foreach ($reservation_data as $k => $val) {
        //     $tmp = [];
        //     $tmp[$k] = $val;
        // }

        return view('/reservation/register/check', compact('user', 'data'))->with('count', $count)->with('user_flg', $user_flg);
    }

    //予約確認画面表示
    public function reservation_register_check_list()
    {
        // return view('/reservation/register/check');
    }

    public function reservation_customer_mie_index()
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectMie();



        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }


        return view('/reservation/mie/index', compact('data', 'empty_seat', 'end_date'));
    }

    public function reservation_customer_kyouto_index()
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectKyoto();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }

        return view('/reservation/kyoto/index', compact('data', 'empty_seat', 'end_date'));
    }

    //カレンダーの予約バーをクリック(京都)
    public function reservation_customer_kyouto_index_add($id)
    {
        // //予約情報一覧取得
        $reservation = new ReservationSetting();
        $data = $reservation->selectReservations($id);

        // $data = $reservation->selectKyoto();

        // //予約状況を取得
        // $entry = new Entry();

        // $empty_seat = [];
        // $end_date = [];


        // if (!empty($id)) {
        //     $reservations = new ReservationSetting();
        //     $reservation = $new_reservations->selectReservations($id);
        // }

        // foreach ($reservation as $val) {
        //     $empty_seat[$val['id']] = (int) $entry->getEmpty($val['id']);

        //     $start_date = new Carbon($val["start_date"]);
        //     $progress = (int) $val["progress"];
        //     $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        // }




        // return view('/reservation/kyoto/index', compact('data', 'empty_seat', 'end_date', 'reservation'));
        return view('/reservation/kyoto/index', compact('data'));
    }

    //カレンダーの予約バーをクリック(三重県)
    public function reservation_customer_mie_index_add($id)
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectMie();

        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];


        if (!empty($id)) {
            $new_reservations = new ReservationSetting();
            $new_reservation = $new_reservations->selectReservations($id);
        }

        foreach ($new_reservation as $val) {
            $empty_seat[$val['id']] = (int) $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }

        return view('/reservation/mie/index', compact('data', 'empty_seat', 'end_date', 'new_reservation'));
    }

    //予約確認後、予約内容登録する
    public function reservation_register_store(Request $request)
    {
        //枠数以上のエントリーを防止
        

        //顧客内容をアカウントに登録
        if (!is_null($request->user_flg)) {
            $account = new Account();

            $account->name = $request->name;
            $account->email = $request->email;
            $account->company_name = $request->company_name;
            if (!empty($request->sales_office)) {
                $account->sales_office = $request->sales_office;
            }
            $account->phone = $request->phone;

            //アカウント登録
            $account->save();
            $account_id = $account->id;
        }

        $entry = new Entry();

        $entry->reservation_id = $request->reservation_id;
        $entry->count = $request->count;
        if (!is_null($request->user_flg)) {
            $entry->account_id = $account_id;
            $entry->user_flg = 0;
        } else {
            $entry->user_id = Auth::user()->id;
            $entry->user_flg = 1;
        }

        //予約をエントリーに登録
        $entry->save();


        //予約完了メール送信

        if (empty(Auth::user())) {
            return redirect('/');
        }


        return redirect('/dashboard');
    }

    //非会員での予約画面
    public function reservation_customer_nomember_index()
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectMie();



        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }


        return view('/reservation/nomember/index', compact('data', 'empty_seat', 'end_date'));
    }

    //カレンダー情報リアルタイム取得(京都)
    public function setEventsNomember(Request $request)
    {
        $reservation = new ReservationSetting();

        //デフォルトの２点のデータ取得
        $data = $reservation->selectNomember();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }


        $start = $this->formatDate($request->all()['start']);

        $end = $this->formatDate($request->all()['end']);

        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->where('place', '=', 2)->get();

        $newArr = [];
        foreach ($events as $item) {
            $count = 0;
            foreach ($empty_seat as $k => $seat) {
                if ($item["id"] == $k) {
                    $count = $seat;
                }
            }
            $newItem["id"] = $item["id"];
            $newItem["title"] = '残り' . $count . '人';
            $newItem["start"] = $item["start_date"];

            $newItem["color"] = '#99CCFF';
            $newItem["textColor"] = 'black';

            $newItem["url"] = 'http://localhost:8888/reservation/nomember/index/' . $item["id"];

            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }

    //カレンダーの予約バーをクリック(非会員)
    public function reservation_customer_nomember_index_add($id)
    {
        // $count = $request->count;

        //予約情報一覧取得
        $reservation = new ReservationSetting();

        $data = $reservation->selectNomember();

        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];
        $end_date = [];


        if (!empty($id)) {
            $new_reservations = new ReservationSetting();
            $new_reservation = $new_reservations->selectReservations($id);
        }

        foreach ($new_reservation as $val) {
            $empty_seat[$val['id']] = (int) $entry->getEmpty($val['id']);

            $start_date = new Carbon($val["start_date"]);
            $progress = (int) $val["progress"];
            $end_date[$val['id']] = $start_date->addDays($progress)->format('Y-m-d');
        }

        return view('/reservation/nomember/index', compact('data', 'empty_seat', 'end_date', 'new_reservation'));
    }

    //アカウント登録(非会員用)
    public function reservation_customer_nomember_account(Request $request)
    {
        $count = $request->count1;
        $reservation_id = $request->id;

        return view('/reservation/nomember/account')->with('count', $count)->with('reservation_id', $reservation_id);
    }

    //アカウント登録後(非会員用)
    public function reservation_customer_nomember_account_create(Request $request)
    {
        $reservation_id = $request->reservation_id;
        $count = $request->count;
        $user_flg = 0;

        // $validator = Validator::make($request->all(), [
        //     'family_name' => ['required', 'string'],
        //     'first_name' => ['required', 'string'],
        //     'email' => ['required', 'email'],
        //     'company_name' => ['required', 'string'],
        //     'sales_office' => ['string', 'nullable'],
        //     'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'between:8,11'],
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/')
        //     ->withErrors($validator)
        //     ->withInput();
        // } else {
        //     return view('sample.index', ['msg' => 'OK']);
        // }

        //顧客情報
        $user = new Account();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_name = $request->company_name;
        $user->phone = $request->phone;
        if (!empty($request->sales_office)) {
            $user->sales_office = $request->sales_office;
        }

        //予約情報
        $reservation = new ReservationSetting();

        $data = $reservation->selectReservation($reservation_id);

        return view('/reservation/register/check', compact('user', 'data'))->with('count', $count)->with('user_flg', $user_flg);
    }

    public function setEventsMeiCount($id)
    {
        $reservation = new ReservationSetting();

        //デフォルトの２点のデータ取得
        $data = $reservation->selectMie();


        //予約状況を取得
        $entry = new Entry();

        $empty_seat = [];

        foreach ($data as $val) {
            if ($val['id'] == $id) {
                $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
            }
            $empty_seat[$val['id']] = $entry->getEmpty($val['id']);
        }


        // $start = $this->formatDate($request->all()['start']);
        // $end = $this->formatDate($request->all()['end']);

        $start = '2020-01-01';
        $end = '2022-12-31';

        $events = ReservationSetting::select('id', 'place', 'start_date', 'progress')->whereBetween('start_date', [$start, $end])->where('place', '=', 11)->get();

        $newArr = [];
        foreach ($events as $item) {
            $count = 0;
            foreach ($empty_seat as $k => $seat) {
                if ($item["id"] == $k) {
                    $count = $seat;
                }
            }
            $left_count = $count - $id;
            $newItem["id"] = $item["id"];
            if ($left_count < 0) {
                $newItem["color"] = 'gray';
                $newItem["title"] = '定員オーバーにより予約不可';
            } else {
                $newItem["color"] = '#99CCFF';
                $newItem["title"] = '残り' . $count . '人';
            }

            $newItem["start"] = $item["start_date"];


            $newItem["textColor"] = 'black';

            if ($left_count >= 0) {
                // $newItem["url"] = 'http://localhost:8888/reservation/mie/index/'.$item["id"];
            }


            $start_date = new Carbon($item["start_date"]);
            $progress = (int) $item["progress"];
            $newItem["end"] = $start_date->addDays($progress)->format('Y-m-d');
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
    }

    public function reservation_list_get($id)
    {
        $newArr = [];

        $reservation = new ReservationSetting();
        $data = $reservation->selectReservation($id);

        $newItem['id'] = $data->id;
        $newItem['start_date'] = $data->start_date;


        $newArr[] = $newItem;
        echo json_encode($newArr);
    }

    public function mie_reservation_store(Request $request)
    {
        $user = Auth::user();

        $user_flg = 1;

        $reservation_count = $request->num;

        $data = [];
        $tmp = [];

        $id =  $request->reservation_id_1;
        $tmp['id'] = $id;
        $tmp['count'] = $request->count_1;

        $reservation = new ReservationSetting();
        
        $reservation_data = $reservation->selectReservation($id);
        $tmp['place'] = $reservation_data->place;
        $tmp['start_date'] = $reservation_data->start_date;
        $tmp['progress'] = $reservation_data->progress;
        $data[1] = $tmp;

        if (!empty($request->reservation_id_2)) {
            $tmp = [];
            $id = $request->reservation_id_2;
            $tmp['id'] = $id;
            $tmp['count'] = $request->count_2;

            $reservation = new ReservationSetting();

            $reservation_data = $reservation->selectReservation($id);
            $tmp['place'] = $reservation_data->place;
            $tmp['start_date'] = $reservation_data->start_date;
            $tmp['progress'] = $reservation_data->progress;
            $data[2] = $tmp;
        }


        return view('/reservation/mie/check', compact('data', 'user'))->with('user_flg', $user_flg);
    }

    public function mie_reservation_store_post(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $entry = new Entry();
        $entry->user_id = $user_id;
        $entry->reservation_id =  $request->reservation_1;
        $entry->count =  $request->count_1;
        $entry->user_flg = 1;

        $entry->save();

        if (isset($request->reservation_2)) {
            $entry = new Entry();
            $entry->user_id = $user_id;
            $entry->reservation_id =  $request->reservation_2;
            $entry->count =  $request->count_2;
            $entry->user_flg = 1;

            $entry->save();
        }
        return redirect('/dashboard');
    }
}
