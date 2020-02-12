<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    //
    protected $table = 'lara_users';

    public function adminLogin(Request $request)
    {
        $credentials = [ 'username' => $request->username , 'password' => $request->password ];
        if (Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }
    }
}
