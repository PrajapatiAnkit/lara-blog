<?php

namespace App\Http\Controllers;
use App\Blog;
use App\Categories;
use App\Http\Requests\ValidationRequestClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class AdminController extends Controller
{
    /**
     * ==============================================================
     * This controller performs the admin login,logout and password update
     */

    /**
     * @uses laravel authentication class to verify login
     *
     * @return boolean
     */

    public function adminLogin()
    {
        /**
         * checks if user is logged in the redirects to dashboard
         */
        if(isset(Auth::user()->email))
        {
            return redirect()->route('dashboard');
        }
        /**
         * otherwise redirect to login page again
         */
        return view('admin.adminLogin');
    }

    /**
     * This is a function redirects user to dashboard if logged in successfully
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param ValidationRequestClass $request
     * @return \Illuminate\Http\JsonResponse
     * @todo it validates login only
     */
    public function validateAdminLogin(ValidationRequestClass  $request)
    {
        $validated = $request->validated();
        $username = $request->input('userName');
        $userPassword = $request->input('userPassword');
        $loginData = array('username'=>$username,'password'=>$userPassword);
      //  print_r($loginData);die();

        /**
         * if user is authenticated, then returns success response with dashboard url
         */
        if (Auth::attempt($loginData)){
            return response()->json(['status' => '1', 'successUrl' => route('dashboard')]);
        }else{
            /**
             * else login failed,return response in json
             */
            return response()->json(['status' => '0']);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * it simply logouts the user
     */
    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function passwordSetting()
    {
        return view('admin.passwordSetting');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @todo it takes current password, if matched then user can create new password
     */
    public function validateCurrentPassword(Request $request)
    {
        $key =  $request->input('key');
        $currentPassword =  $request->input('currentPassword');
        $auth = Auth::user();

        if ($key == 'verifyPassword'){
            /**
             * verifies if current password matched with old one
             */
            if (Hash::check($currentPassword,$auth->getAuthPassword())){
                return response()->json(['statusValue'=>1,'password'=>'verified']);
            }else{
                /**
                 * else not matched
                 */
                return response()->json(['statusValue'=>0]);
            }
        }else if ($key == 'verified'){
            /**
             * current password verified
             */
            $newPassword = $request->input('newPassword');
            /**
             * find the current use id
             */
            $userId =  $auth->id;

           $updatePassword =  $auth->update(array('password' =>bcrypt($newPassword)));
           if ($updatePassword){
               /**
                * if password updated,return success json response
                */
               return response()->json(['updateStatus'=>1]);
           }else{
               return response()->json(['updateStatus'=>0]);
           }

        }
    }


}
