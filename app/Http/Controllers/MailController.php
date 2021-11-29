<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;                   //追記
use App\Mail\ContactReply; //追記
use App\Mail\MailSend;
use App\Models\Account;
use App\Models\Email;
use App\Models\EmailContent;
use App\Models\AdressList;
use Carbon\Carbon;

class MailController extends Controller
{
    public function mail_send(Request $request)
    {
        $account = new Account();
        $account_data = $account->getAllData();

        foreach ($account_data as $data) {
            $to = $data->email;
            $name = $data->name;
            $title = $request->title;
            $mail_text = $request->mail_text;
            
            
            Mail::to($to)->send(new MailSend($name, $title, $mail_text));
        }

        die('送信完了しました');
    }

    public function select_mail_index(Request $request)
    {
        $check_account = $request->check;

        $account_data = [];
        
        foreach ($check_account as $k => $id) {
            $id = (int) $id;
            $tmp = [];
            $account = new Account();
            $data = $account->getAccount($id);

            $tmp['id'] = $id;
            $tmp['email'] = $data['email'];
            $tmp['name'] = $data['name'];
            $account_data[$k] = $tmp;
        }
        return view('/management/mail/select', compact('account_data'));
    }

    public function select_mail_index_all()
    {
        $account_data = [];

        $account = new Account();
        $data = $account->getData();
        
        foreach ($data as $k => $val) {
            $tmp['id'] = $val->id;
            $tmp['email'] = $val->email;
            $tmp['name'] = $val->name;
            $account_data[$k] = $tmp;
        }
        return view('/management/mail/select', compact('account_data'));
    }

    

    public function select_mail_index_get()
    {
    }

    public function select_mail_create(Request $request)
    {
        $check_account = $request->check;

        $account_data = [];

        foreach ($check_account as $k =>$id) {
            $id = (int) $id;
            $tmp = [];
            $account = new Account();
            $data = $account->getAccount($id);

            $tmp['id'] = $id;
            $tmp['email'] = $data['email'];
            $tmp['name'] = $data['name'];
            $account_data[$k] = $tmp;
        }
        return view('/management/mail/create', compact('account_data'));
    }

    public function select_mail_check(Request $request)
    {
        $check_account = $request->check;

        $account_data = [];

        foreach ($check_account as $k =>$id) {
            $id = (int) $id;
            $tmp = [];
            $account = new Account();
            $data = $account->getAccount($id);

            $tmp['id'] = $id;
            $tmp['email'] = $data['email'];
            $tmp['name'] = $data['name'];
            $account_data[$k] = $tmp;
        }

        $mail_text = $request->mail_text;
        $title  = $request->title;

        return view('/management/mail/check', compact('account_data'))->with('mail_text', $mail_text)->with('title', $title);
    }

    public function select_mail_send(Request $request)
    {
        $check_account = $request->check;
        $mail_text = $request->mail_text;
        $title  = $request->title;

        $account_data = [];

        foreach ($check_account as $k =>$id) {
            $account = new Account();
            $data = $account->getAccount($id);

            $to = $data['email'];
            $name = $data['name'];
            $mail_text = $request->mail_text;
            $title  = $request->title;


            Mail::to($to)->send(new MailSend($name, $title, $mail_text));
        }

        die('送信完了しました');
    }

    public function mail_history_index(Request $request)
    {
        $email = new Email();
        $email_data = $email->getData();

        $data = [];

        foreach ($email_data as $k => $val) {
            $tmp = [];
            $tmp['type'] = $val->type == 1  ? 'メール' : 'SMS';
            $tmp['created_at'] = $val->created_at;

            $adress_list = new AdressList();
            $adress_list_data = $adress_list->getAccountList($val->adress_id);

            $account = [];
            foreach ($adress_list_data as $t => $list) {
                $item = [];
                $account[$t] = $list['account_id'];
            }


            $account = new Account();
            $account_data = $account->getAccount($val->account_id);
            $tmp['adress'] = $account_data->name;

            $email_content = new EmailContent();
            $email_content_data = $email_content->getContent($val->email_content_id);
            $tmp['email_content'] = $email_content_data->mail_text;

            $tmp['content_id'] = $email_content_data->id;

            $data[$k] = $tmp;
        }

        return view('/management/mail/history/index', compact('data'));
    }

    public function mail_history_detail($id)
    {
        $email_content = new EmailContent();
        $email_content_data = $email_content->getContent($id);
        $mail_text = $email_content_data->mail_text;
        $title = $email_content_data->title;


        return view('/management/mail/history/detail')->with('mail_text', $mail_text)->with('title', $title);
    }
}
