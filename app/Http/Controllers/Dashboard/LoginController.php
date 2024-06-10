<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        //
    }

    public function logout()
    {
        //
    }
    public function register()
    {
        //
    }
    public function register_action(Request $request)
    {
        //
    }
}
