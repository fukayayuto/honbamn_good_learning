<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailableController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\SetEventController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Ajax;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ReservationController::class, 'home'])->name('home');

//自作ログイン機能
// Route::get("/my-login", [LoginController::class, "index"])->name("myLogin");


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');;


Route::get('/account', function () {
    return view('form');
});


Route::get('/count', [ReservationController::class, 'select'])->name('count');

Route::post('/count', [ReservationController::class, 'next'])->name('reservation_select');

Route::get('/count_0', [ReservationController::class, 'select0']);

Route::post('/count_0', [ReservationController::class, 'select0']);


// Route::post('/count_user', [ReservationController::class, 'next_user']);

//会員用ボタン
Route::post('/user_check', [ReservationController::class, 'user_check']);

//人数確認画面
Route::get('/reservation', [ReservationController::class, 'index']);

//日付選択後
Route::post('/reservation', [ReservationController::class, 'reservation_create'])->name('reservation_create');

//予約確認画面
Route::post('/check', [ReservationController::class, 'reservation_check'])->name('reservation_check');

Route::get('/check', [ReservationController::class, 'reservation'])->name('reservation');

Route::post('/reservation/register', [ReservationController::class, 'reservation_register'])->name('reservation_register');



Route::get('/account', [AccountController::class, 'index'])->name('account');

Route::post('/account', [AccountController::class, 'post'])->name('account_create');

Route::post('/setting/date', [ReservationController::class, 'setting_date_post'])->name('setting_date');

Route::get('/setting/date', [ReservationController::class, 'setting_date']);

//予約日時設定詳細
// Route::post('/setting/reservation/{id}', [ReservationController::class, 'setting_reservation_post']);

Route::get('/setting/reservation/{id}', [ReservationController::class, 'setting_reservation']);

//予約日時設定詳細変更
Route::post('/setting/reservation/change', [ReservationController::class, 'setting_reservation_change'])->name('setting_reservation_change');

//予約日時新規作成
Route::get('/setting/add', [ReservationController::class, 'setting_reservation_add']);

Route::post('/setting/add', [ReservationController::class, 'setting_reservation_add_post']);

//新規予約(人数選択画面表示)
Route::get('/reservation/customer/select', [ReservationController::class, 'reservation_customer_select']);

//新規予約(人数選択後)
Route::post('/reservation/customer/select', [ReservationController::class, 'reservation_customer_select_post'])->name('reservation_customer_select');

//予約確認画面表示
Route::get('/reservation/check/{id}/{count}', [ReservationController::class, 'reservation_check_list']);

Route::post('/reservation/register', [ReservationController::class, 'reservation_register_second'])->name('reservation_register_second');


Route::get('/mail', function () {
    $mail_text = "メールテストで使いたい文章を記載";
    Mail::to('to_address@example.com')->send(new MailTest($mail_text));
});

Route::post('/mail', function () {
    $mail_text = "メールテストで使いたい文章を記載";
    Mail::to('to_address@example.com')->send(new MailTest($mail_text));
});

Route::get('contact2', [MailableController::class, 'index']);

Route::post('contact2', [MailableController::class, 'send']);

Route::get('/calendar', [CalendarController::class, 'show']);

//カレンダー表示用のデータ取得(デフォルト)
Route::get('/setEvents', [ReservationController::class, 'setEvents']);

//カレンダー表示用のデータ取得(三重県)
Route::get('/setEvents/mieken', [ReservationController::class, 'setEventsMei']);

//カレンダー表示用のデータ取得(京都府)
Route::get('/setEvents/kyouto', [ReservationController::class, 'setEventsKyoto']);


//カレンダー表示用のデータ取得
Route::get('/setEventsTest', [ReservationController::class, 'setEventsTest']);


//予約人数選択画面
Route::get('/reservation/index', [ReservationController::class, 'reservation_customer_index']);

// //会員用予約ボタンタップ
// Route::post('/reservation/index/{id}', [ReservationController::class, 'reservation_customer_index_post'])->name('reservation_index');

//カレンダーの予約バーをクリック
Route::get('/reservation/index/{id}', [ReservationController::class, 'reservation_customer_index_add'])->name('reservation_index');

//予約確認画面をタップ
Route::post('/reservation/register/check', [ReservationController::class, 'reservation_register_check'])->name('reservation_register_check');

Route::get('/reservation/register/check', [ReservationController::class, 'reservation_register_check_list']);

//三重県での予約画面
Route::get('/reservation/mie/index', [ReservationController::class, 'reservation_customer_mie_index']);

//京都府での予約画面
Route::get('/reservation/kyoto/index', [ReservationController::class, 'reservation_customer_kyouto_index']);

//カレンダーの予約バーをクリック(京都)
Route::get('/reservation/kyoto/index/{id}', [ReservationController::class, 'reservation_customer_kyouto_index_add'])->name('reservation_kyoto_index');

//カレンダーの予約バーをクリック(京都)
Route::get('/reservation/kyoto/index/{id}', [ReservationController::class, 'reservation_customer_kyouto_index_add'])->name('reservation_kyoto_index');



//カレンダーの予約バーをクリック(京都)
Route::get('/reservation/mie/index/{id}', [ReservationController::class, 'reservation_customer_mie_index_add'])->name('reservation_mie_index');

//予約確認後、予約内容登録する
Route::post('/reservation/register/store', [ReservationController::class, 'reservation_register_store'])->name('reservation_register_store');

//予約確認後、予約内容登録する
Route::get('/reservation/register/store', [ReservationController::class, 'reservation_register_store_get']);



//非会員での予約画面
Route::get('/reservation/nomember/index', [ReservationController::class, 'reservation_customer_nomember_index'])->name('reservation_customer_nomember_index');

//カレンダー表示用のデータ取得(非会員用)
Route::get('/setEvents/nomember', [ReservationController::class, 'setEventsNomember']);

//カレンダーの予約バーをクリック(非会員)
Route::get('/reservation/nomember/index/{id}', [ReservationController::class, 'reservation_customer_nomember_index_add'])->name('reservation_nomember_index');

//アカウント入力画面
Route::post('/reservation/nomember/account', [ReservationController::class, 'reservation_customer_nomember_account'])->name('nomember_account');

//アカウント入力画面
Route::get('/reservation/nomember/account', [ReservationController::class, 'reservation_customer_nomember_account_index']);

//アカウント入力画面後
Route::post('/reservation/nomember/account/create', [ReservationController::class, 'reservation_customer_nomember_account_create'])->name('nomember_account_create');

//アカウント入力画面後
Route::get('/reservation/nomember/account/create', [ReservationController::class, 'reservation_customer_nomember_account_create_index']);

//カレンダー表示用のデータ取得(三重県)
Route::get('/setEvents/mieken/count/{id}', [ReservationController::class, 'setEventsMeiCount']);



//インフォメーション


//インフォメーションの詳細を表示
Route::get('/infomation/detail/{id}', [InfoController::class, 'detail'])->name('infomation_detail');


//ajax動作確認
Route::get('/reservation/load', [AccountController::class, 'load']);


//ajax動作確認
Route::get('/contacts', [ContactController::class, 'index']);
Route::post('/ajax/contacts', [App\Http\Controllers\Ajax\ContactController::class, 'store']);

//予約確認詳細
Route::get('/reservation/detail/{id}', [HomeController::class, 'reservation_detail']);

//予約キャンセル処理
Route::post('/reservation/delete/{id}', [EntryController::class, 'delete']);

Route::get('/reservation/delete/{id}', [EntryController::class, 'delete_index']);

//カレンダーの予約バーをクリック(京都)
Route::get('/reservation/list/{id}', [ReservationController::class, 'reservation_list_get']);




//三重県登録部分
Route::post('/reservation/mie/store', [ReservationController::class, 'mie_reservation_store'])->name('mie_reservation_store');

Route::get('/reservation/mie/store', [ReservationController::class, 'mie_reservation_store_index']);

Route::post('/reservation/mie/store/post', [ReservationController::class, 'mie_reservation_store_post'])->name('reservation_mie_register_store');

Route::get('/reservation/mie/store/post', [ReservationController::class, 'mie_reservation_store_post_index']);


//予約画面(最新)
Route::get('/reservation/entry/index', [ReservationController::class, 'reservation_entry_index'])->name('reservation_entry_index');

//カレンダー表示用のデータ取得(デフォルト)
Route::get('/setEvents/entry', [SetEventController::class, 'setEvents_entry']);

//予約画面(最新)
Route::get('/reservation/entry/index/{id}', [ReservationController::class, 'reservation_entry_index_add']);





//管理画面部分****************************************************************************************************************************************************


//マネージメント画面
Route::get('/management/index', [ManagementController::class, 'index']);


//マネージメント画面(予約情報の管理)
Route::get('/management/reservation/index', [ManagementController::class, 'reservation_index']);

//マネージメント画面(予約情報の登録)
Route::post('/management/reservation/store', [ManagementController::class, 'reservation_store'])->name('reservation_store');

Route::get('/management/reservation/store', [ManagementController::class, 'reservation_store_index']);

//マネージメント画面(予約情報の編集画面)
Route::get('/management/reservation/detail/{id}', [ManagementController::class, 'reservation_detail']);

//マネージメント画面(予約情報の編集後)
Route::post('/management/reservation/detail/edit', [ManagementController::class, 'reservation_detail_edit'])->name('reservation_detail_edit');

Route::get('/management/reservation/detail/edit', [ManagementController::class, 'reservation_detail']);

//マネージメント画面(予約情報の削除後)
Route::get('/management/reservation/delete/{id}', [ManagementController::class, 'reservation_delete']);


//マネージメント画面(予約情報のエントリー表示)
Route::get('/management/reservation/list/{id}', [ManagementController::class, 'reservation_entry_list']);


//マネージメント画面(予約情報のカレンダー表示)
Route::get('/management/reservation/calendar/list', [ManagementController::class, 'reservation_calendar_list']);


//マネージメント画面(インフォメーションの表示)
Route::get('/management/information/index', [ManagementController::class, 'information_index']);

//マネージメント画面(インフォメーションの登録)
Route::post('/management/information/store', [ManagementController::class, 'information_store'])->name('information_store');

Route::get('/management/information/store', [ManagementController::class, 'information_store_index']);

//マネージメント画面(インフォメーション情報の編集画面)
Route::get('/management/information/detail/{id}', [ManagementController::class, 'information_detail']);

//マネージメント画面(インフォメーション情報の編集後)
Route::post('/management/information/detail/edit', [ManagementController::class, 'information_detail_edit'])->name('information_detail_edit');

Route::get('/management/information/detail/edit', [ManagementController::class, 'reservation_detail_edit_index']);

//マネージメント画面(インフォメーション情報の削除)
Route::post('/management/information/delete/{id}', [ManagementController::class, 'information_delete']);

Route::get('/management/information/delete/{id}', [ManagementController::class, 'information_delete_index']);


//カレンダー表示用のデータ取得(非会員用)
Route::get('/setEvents/all', [SetEventController::class, 'setEventsAll']);


//マネージメント画面(ユーザー情報表示)
Route::get('/management/user/index', [ManagementController::class, 'user_index']);

//マネージメント画面(ユーザー詳細情報表示)
Route::get('/management/user/detail/{id}', [ManagementController::class, 'user_detail']);


//マネージメント画面(メール送信画面表示)
Route::get('/management/mail/index', [ManagementController::class, 'mail_index']);

//マネージメント画面(メール送信画面表示)
Route::post('/management/mail/send', [MailController::class, 'mail_send'])->name('mail_send');

//マネージメント画面(メール送信画面表示)
Route::post('/management/mail/select/index', [MailController::class, 'select_mail_index'])->name('select_mail_index');

Route::get('/management/mail/select/index', [MailController::class, 'select_mail_index_all']);

//選択した人向けのメール作成画面
Route::post('/management/mail/select/create', [MailController::class, 'select_mail_create'])->name('select_mail_create');

Route::get('/management/mail/select/create', [MailController::class, 'select_mail_create_get']);


Route::post('/management/mail/select/check', [MailController::class, 'select_mail_check'])->name('select_mail_check');

Route::post('/management/mail/select/send', [MailController::class, 'select_mail_send'])->name('select_mail_send');

//メール履歴表示
Route::get('/management/mail/history/index', [MailController::class, 'mail_history_index']);

//メール履歴詳細表示
Route::get('/management/mail/history/index/{id}', [MailController::class, 'mail_history_detail']);

//メール履歴送信者リスト表示
Route::get('/management/mail/history/send/{id}', [MailController::class, 'mail_history_send_list']);



//****************************************************************************************************************************************************


// ログイン
Route::get('/admin_login', function () {
    return view('login');
});
Route::POST('/admin_login', 'AdminController@login');
Route::get('/admin_logout', 'LoginController@logout')->middleware('login');

// ログイン
Route::get('/managemant/login', function () {
    return view('/management/login');
});
Route::POST('/admin_login', [AdminController::class, 'login']);
Route::get('/admin_logout', [AdminController::class, 'logout'])->middleware('login');


Route::get('/test', function () {
    return view('test');
});



//ここから本番環境
Route::get('/good_learning/about', [HomeController::class, 'good_learning_about_cost']);

//ここから本番環境
Route::get('/good_learning/reservation/{id}', [ReservationController::class, 'reservation_store_form']);


Route::get('/good_learning/test', function () {
    return view('/good_learning/test');
});


//ここから本番環境
Route::get('/good_learning/truck', [HomeController::class, 'truck_index']);
