<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


/* home page routes */
Route::get('/','HomeController@index')->name('home');
Route::get('/contact','HomeController@contact')->name('contact');
Route::get('/signup','HomeController@signup')->name('signup');
Route::get('/login','HomeController@login')->name('login');


/* admin login & logout routes */
Route::get('/admin','AdminController@adminLogin')->name('adminLogin');
Route::get('/admin/login','AdminController@adminLogin')->name('adminLogin');
Route::get('/admin/adminLogout','AdminController@adminLogout')->name('adminLogout');
Route::post('/admin/validateAdminLogin','AdminController@validateAdminLogin')->name('validateAdminLogin');

/* admin pages inside */
Route::get('/admin/dashboard','AdminController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/admin/add-blog','BlogController@addBlog')->name('addBlog')->middleware('auth');
Route::get('/admin/blog-list','BlogController@blogList')->name('blogList')->middleware('auth');
Route::get('/admin/users-list','BlogController@usersList')->name('usersList')->middleware('auth');

/* blog add/edit/delete routes */

Route::post('/admin/saveBlog','BlogController@saveBlog')->name('saveBlog');
Route::get('/admin/categories','BlogController@categories')->name('categories');
Route::get('/admin/add-category','BlogController@showAddCategoryForm')->name('addcategory');
Route::post('/admin/saveCategory','BlogController@saveCategory')->name('saveCategory');
Route::get('/admin/password-setting','AdminController@passwordSetting')->name('passwordSetting');
Route::post('/admin/validateCurrentPassword','AdminController@validateCurrentPassword')->name('validateCurrentPassword');

