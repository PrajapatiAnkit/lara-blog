<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('admin.adminLogin');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function validateAdminLogin(Request $request)
    {
        $validation = $request->validate([
            'userName' => 'required',
            'userName' => 'userPassword',
        ]);
    }
}
