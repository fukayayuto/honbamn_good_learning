<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;                   //追記
use App\Mail\ContactReply; //追記
// use App\Http\Controllers\MailTest;
use App\Mail\MailTest;


class MailableController extends Controller
{
    //以下追記
    public function index() //コンタクトフォームの表示
    {
        return view('contact.index');
    }

    public function send(Request $request)  //メールの自動送信設定
    {
        

        Mail::to('to_address2@example.com')
              ->send(new MailTest($request->name));

        // Mail::to('to_address@example.com')
        //       ->send(new ContactReply());

        return back()->withInput($request->only(['name']))
                     ->with('sent', '送信完了しました。');    //送信完了を表示
    }
}