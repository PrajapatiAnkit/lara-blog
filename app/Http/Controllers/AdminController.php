<?php

namespace App\Http\Controllers;
use App\Admin;
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
        if (Auth::attempt(array('username'=>$username,'password'=>$userPassword))){
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
        $currentPassword =  $request->input('currentPassword');
        $auth = Auth::user();
        if (! (Hash::check($request->get('old_password'),$currentPassword ))){
            throw new Exception('notMatched');
        }

       /* $check = DB::table('lara_users')->where(
            array('password'=>Hash::make($currentPassword), 'id'=>Auth::id())
        )->get();

        print_r($check);*/
    }






}
