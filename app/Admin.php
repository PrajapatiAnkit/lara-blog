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

    /**
     * This function updates users profile
     * @param $request
     * @return bool
     */
    public static function updateProfile($request)
    {
        if ($request->input('preProfilePic') !=''){
            unlink(public_path('assets/profile/'.$request->input('preProfilePic')));
        }

        /**
         * This checks if user selects new profile pic
         */
        if (!empty($request->file('profilePic'))){
            $file = $request->file('profilePic');
            $profilePicName = $file->getClientOriginalName();
            $file->move(public_path('assets/profile'),$profilePicName);
        }else{
            /**
             * else profile pictures remains the same
             */
            $profilePicName = $request->input('preProfilePic');
        }


        $admin = Self::find(Auth::id());
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->contact = $request->input('contact');
        $admin->profile = $profilePicName;
        /**
         * If profile details saved return true
         */
        if ($admin->save()){
            return true;
        }else{
            /**
             * else return the false
             */
            return false;
        }
    }

}
