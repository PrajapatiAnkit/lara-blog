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


Route::get('/','HomeController@index')->name('home');
Route::get('/contact','ContactController@index')->name('contact');
Route::get('/signup','UsersController@signup')->name('signup');
Route::get('/login','UsersController@login')->name('login');

/* admin routes */

Route::get('/admin/login','AdminController@adminLogin')->name('adminLogin');
Route::get('/admin/adminLogout','AdminController@adminLogout')->name('adminLogout');
Route::post('/admin/validateAdminLogin','AdminController@validateAdminLogin')->name('validateAdminLogin');
Route::get('/admin/dashboard','AdminController@dashboard')->name('dashboard');
Route::get('/admin/add-blog','BlogController@addBlog')->name('addBlog');
Route::get('/admin/blog-list','BlogController@blogList')->name('blogList');
Route::get('/admin/users-list','BlogController@usersList')->name('usersList');
