<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function post(Request $request)
    {
        $account = new Account();


        $account->family_name = $request->family_name;
        $account->first_name = $request->first_name;
        $account->email = $request->email;
        $account->company_name = $request->company_name;
        $account->sales_office = $request->sales_office;
        $account->phone = $request->phone;
    
        $account->save();

        return view('form');
    }


    public function user_check(Request $request)
    {

        //会員状態の確認
        if (!empty(Auth::user())) {
            $user = Auth::user();

            return view('count_form')->with('user', $user);
        }
        
        return view('');
    }

    public function load()
    {
        $account = new Account();
        $data = $account->getData();

        return response()->json($data);
    }
}
