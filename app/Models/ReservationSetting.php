<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Entry;

class ReservationSetting extends Model
{
    use HasFactory;

    protected $fillable = ['count', 'start_date', 'progress', 'place'];

    public function getData()
    {
        $data = DB::table('reservation_settings')->get();

        return $data;
    }

    public function getFind($id)
    {
        $data = DB::table('reservation_settings')->find($id);

        return $data;
    }

    public function updateOne($data)
    {
        ReservationSetting::where('id', '=', $data['id'])->update([
            'start_date' => $data['start_date'],
            'progress' => $data['progress'],
            'count' => $data['count'],
            'place' => $data['place'],
        ]);
    }

    public function selectDefalut()
    {
        $data = ReservationSetting::where('place', '=', 1)->get();

        return $data;
    }

    //会員と非会員を取得
    public function selectDef()
    {
        $data = ReservationSetting::whereBetween('place', [1, 2])->get();

        return $data;
    }

    //座席数取得
    public function leftSeat($data)
    {
        $entry = new Entry();
    }



    public function selectReservation($id)
    {
        $data = ReservationSetting::where('id', '=', $id)->first();

        return $data;
    }

    public function selectReservations($id)
    {
        $data = ReservationSetting::where('id', '=', $id)->get();

        return $data;
    }

    //三重県のデータ取得
    public function selectMie()
    {
        $data = ReservationSetting::where('place', '=', 11)->get();

        return $data;
    }

    //京都府のデータ取得
    public function selectKyoto()
    {
        $data = ReservationSetting::where('place', '=', 21)->get();

        return $data;
    }

    //非会員のデータ取得
    public function selectNomember()
    {
        $data = ReservationSetting::where('place', '=', 2)->get();

        return $data;
    }

    //ユーザー個別のデータ収集
    public function userSelectReservation($id)
    {
        $data = ReservationSetting::where('id', '=', $id)->first();

        return $data;
    }

    //全データ取得
    public function getAllData()
    {
        $data = DB::table('reservation_settings')->latest()->get();

        return $data;
    }

    //全データ取得
    public function serachReservation($array = [])
    {
        if (!empty($array['start_date']) && !empty($array['place'])) {
            $data = ReservationSetting::where('start_date', '=', $array['start_date'])->where('place', '=', $array['place'])->get();
            return $data;
        }

        if (!empty($array['start_date'])) {
            $data = ReservationSetting::where('start_date', '=', $array['start_date'])->get();
            return $data;
        }

        if (!empty($array['place'])) {
            $data = ReservationSetting::where('place', '=', $array['place'])->get();
            return $data;
        }
    }

    //会員用予約情報取得
    public function getReservationData()
    {
        $data = ReservationSetting::where('place', '=', 1)->orderBy('start_date')->get();

        return $data;
    }

    //同じ日付データ取得
    public function getReservationDataNomember($start_date)
    {
        $data = ReservationSetting::where('start_date', '=', $start_date)->where('place', '=', 2)->first();

        return $data;
    }
}
