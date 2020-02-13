<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function signup()
    {
        return view('user.usersignup');
    }

    public function login()
    {
        return view('user.userlogin');
    }
}
