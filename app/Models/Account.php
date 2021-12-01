<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    use HasFactory;
    // public $family_name = '';
    // public $first_name = '';
    // public $email = '';
    // public $company_name = '';
    // public $sales_office = '';
    // public $phone = '';


    // public function register($data)
    // {
    //     $account = new Account();

    //     $account->family_name = $data->;
    //     $account->first_name = $request->first_name;
    //     $account->email = $request->email;
    //     $account->company_name = $request->company_name;
    //     if (!empty($request->sales_office)) {
    //         $account->sales_office = $request->sales_office;
    //     }
    //     $account->phone = $request->phone;

    //     $account->save();

    // }

    public function getData()
    {
        $data = DB::table('accounts')->get();

        return $data;
    }

    public function getAccount($account_id)
    {
        $user = Account::where('id', '=', $account_id)->first();

        return $user;
    }

    public function getAllData()
    {
        $data = DB::table('accounts')->latest()->get();

        return $data;
    }
}
