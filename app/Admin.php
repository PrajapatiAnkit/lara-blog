<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    /**
     * it is just a table name
     * @var string
     */
    protected $table = 'users';

    public static function updateProfile($request)
    {
        if ($request->input('preProfilePic') !=''){
//            echo public_path('assets/profile/'.$request->input('preProfilePic'));die();
            unlink(public_path('assets/profile/'.$request->input('preProfilePic')));
        }

        if (!empty($request->file('profilePic'))){
            $file = $request->file('profilePic');
            $profilePicName = $file->getClientOriginalName();
            $file->move(public_path('assets/profile'),$profilePicName);
        }else{
            $profilePicName = $request->input('preProfilePic');
        }



        $admin = Self::find(Auth::id());
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->contact = $request->input('contact');
        $admin->profile = $profilePicName;
        if ($admin->save()){
            return true;
        }else{
            return false;
        }
    }

}
