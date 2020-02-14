<?php

namespace App\Http\Controllers;
use App\Blog;
use App\Categories;
use App\Http\Requests\ValidationRequestClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;
use Validator;
class AdminController extends Controller
{

    public function adminLogin()
    {
        if(isset(Auth::user()->email))
        {
            return redirect()->route('dashboard');
        }

        return view('admin.adminLogin');
    }
    public function dashboard()
    {
        $totalBlogs = Blog::count();
        $totalCategories = Categories::count();

       // $user = Auth::user();

        $data = array(
            'totalBlogs'=>$totalBlogs,
            'totalCategories'=>$totalCategories,
        );


        return view('admin.dashboard',$data);
    }

    public function validateAdminLogin(ValidationRequestClass  $request)
    {
        $validated = $request->validated();
        $username = $request->input('userName');
        $userPassword = $request->input('userPassword');
        $loginData = array('username'=>$username,'password'=>$userPassword);
      //  print_r($loginData);die();

        if (Auth::attempt($loginData)){
            return response()->json(['status' => '1', 'successUrl' => route('dashboard')]);
        }else{
            return response()->json(['status' => '0']);
        }
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }

    public function passwordSetting()
    {
        return view('admin.passwordSetting');
    }

    public function validateCurrentPassword(Request $request)
    {
        $key =  $request->input('key');
        $currentPassword =  $request->input('currentPassword');
        $auth = Auth::user();

        if ($key == 'verifyPassword'){

            if (Hash::check($currentPassword,$auth->getAuthPassword())){
                return response()->json(['statusValue'=>1,'password'=>'verified']);
            }else{
                return response()->json(['statusValue'=>0]);
            }
        }else if ($key == 'verified'){
            $newPassword = $request->input('newPassword');
            $userId =  $auth->id;

           $updatePassword =  $auth->update(array('password' =>bcrypt($newPassword)));
           if ($updatePassword){
               return response()->json(['updateStatus'=>1]);
           }else{
               return response()->json(['updateStatus'=>0]);
           }

        }
    }






}
