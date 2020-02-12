<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Http\Requests\ValidationRequestClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
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

    public function validateAdminLogin(ValidationRequestClass  $request)
    {
        $validated = $request->validated();
        $username = $request->input('userName');
        $userPassword = $request->input('userPassword');


        if (Auth::attempt(array('username'=>$username,'password'=>$userPassword))){
            return response()->json(['status' => '1', 'successUrl' => route('dashboard')]);
           // echo Auth::user()->id;
        }else{
            return response()->json(['status' => '0']);
        }
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }


}
