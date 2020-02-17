<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ==============================================================
     * The purpose of this controller is to load the various layout files
     */


    /**
     * @todo loads the home page of the website
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.home');
    }

    /**
     *  @todo loads the contact page of the website
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('user.contact');
    }

    /**
     * @todo loads the usersignup page of the website
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signup()
    {
        return view('user.usersignup');
    }

    /**
     * @todo loads the userlogin page of the website
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('user.userlogin');
    }
}
