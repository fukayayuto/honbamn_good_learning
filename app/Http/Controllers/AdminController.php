<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
// 追加分
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
class AdminController extends Controller
{
    public function login(Request $request)
    {
        $user = Admin::where('name', $request->name)->get();
        if (count($user) === 0) {
            return view('/management/login', ['login_error' => '1']);
        }
        
        // 一致
        if (Hash::check($request->password, $user[0]->password)) {
            
            // セッション
            session(['name'  => $user[0]->name]);
            
            // フラッシュ
            session()->flash('flash_flg', 1);
            session()->flash('flash_msg', 'ログインしました。');
                  
            return redirect(url('/management/index'));
        // 不一致
        } else {
            return view('login', ['login_error' => '1']);
        }
    }
    
    public function logout(Request $request)
    {
        session()->forget('name');
        return redirect(url('/'));
    }
}
