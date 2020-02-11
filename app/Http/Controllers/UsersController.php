<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {

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
