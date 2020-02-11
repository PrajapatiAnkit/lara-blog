<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

    public function validateAdminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required',
            'userPassword' => 'required',
        ],[
            'userName.required' => 'Username required.',
            'userPassword.required' => 'Password required.',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()],422);
        }

        $username = $request->input('userName');
        $userPassword = $request->input('userPassword');


        $query = DB::select("SELECT * lara_users WHERE username=? AND password=?",$username,$userPassword);
        print_r($query);
            //return response()->json(['success'=>'Record is successfully added']);

    }
}
