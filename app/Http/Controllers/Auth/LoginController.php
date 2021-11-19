<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function index()
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        die('u');
        return redirect('login');
    }
}
