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
            //メール送信用
            $account = new Account();
            $data = $account->getAccount($id);

            $to = $data['email'];
            $name = $data['name'];
            $mail_text = $request->mail_text;
            $title  = $request->title;

            Mail::to($to)->send(new MailSend($name, $title, $mail_text));
        }

        //アカウントID決定
        $account_list = new AdressList();
        $last_adress_id = $account_list->max('adress_id');
        $account_id = $last_adress_id + 1;

        //メールアカウントID情報登録
        foreach ($check_account as $k =>$id) {
            $account_list = new AdressList();
            $account_list->adress_id = $account_id;
            $account_list->account_id = $id;
            $account_list->save();
        }

        //メールコンテンツ登録
        $email_content = new EmailContent();
        $email_content->adress_id = $account_id;
        $email_content->title = $title;
        $email_content->mail_text = $mail_text;
        $email_content->save();

        $email_content_id = $email_content->id;

        //メール履歴登録
        $email = new Email();
        $email->email_content_id = $email_content_id;
        //メールは１、SMSは２
        $email->type = 1;
        $email->save();


        return redirect('/management/mail/history/index');
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

            $email_content = new EmailContent();
            $email_content_data = $email_content->getContent($val->email_content_id);
            $adress_list_id = $email_content_data->adress_id;

            $adress_list = new AdressList();
            $adress_list_data = $adress_list->getAccountList($adress_list_id);

            $tmp['adress'] = '';
            $tmp['id_list'] = [];

            foreach ($adress_list_data as $t => $list) {
                $tmp_account = [];
                
                $account = new Account();
                $account_data = $account->getAccount($list->account_id);

                $tmp_account['id'] = $account_data->id;
                $tmp_account['name'] = $account_data->name;

                $tmp['adress'] = $tmp['adress'] .','. $tmp_account['name'];
                $tmp['id_list'][$t] = $account_data->id;
            }
            $tmp['adress'] = substr($tmp['adress'], 1);



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
        $adress_id = $email_content_data->adress_id;
        
        $adress_list = new AdressList();
        $adress_list_data = $adress_list->getAccountList($adress_id);

        $adress = '';
        foreach ($adress_list_data as $val) {
            $account = new Account();
            $account_data = $account->getAccount($val->account_id);

            $adress = $adress . ',' . $account_data->name;
        }

        $adress = substr($adress, 1);

        $mail_text = $email_content_data->mail_text;
        $title = $email_content_data->title;


        return view('/management/mail/history/detail')->with('mail_text', $mail_text)->with('title', $title)->with('adress', $adress);
    }
    
    public function mail_history_send_list($id)
    {
        $email_content = new EmailContent();
        $email_content_data = $email_content->getContent($id);
        $adress_id = $email_content_data->adress_id;
        
        $adress_list = new AdressList();
        $account_list_id= $adress_list->getAccountList($adress_id);

        $account_list = [];
        foreach ($account_list_id as $k => $val) {
            $tmp = [];
            $account = new Account();
            $account_data = $account->getAccount($val->account_id);
            $tmp['name'] = $account_data->name;
            $tmp['email'] = $account_data->email;
            $account_list[$k] = $tmp;
        }

        return view('/management/mail/history/send_list', compact('account_list'));
    }

    public function auto_send()
    {
        return 'auto_send が呼ばれました！';
    }
}
