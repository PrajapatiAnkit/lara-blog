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


/* ========================================================================================*/
/*                            ADMIN LOGIN ROUTES                                           */
/* ========================================================================================*/
Route::get('/admin','AdminController@adminLogin')->name('adminLogin');
Route::get('/admin/login','AdminController@adminLogin')->name('adminLogin');
Route::get('/admin/adminLogout','AdminController@adminLogout')->name('adminLogout');
Route::post('/admin/validateAdminLogin','AdminController@validateAdminLogin')->name('validateAdminLogin');

/* ========================================================================================*/
/*                            ADMIN PANEL ROUTES                                           */
/* ========================================================================================*/

                /* admin pages routes after login */
Route::get('/admin/dashboard','AdminController@dashboard')->name('dashboard')->middleware('auth');
Route::get('/admin/add-blog','BlogController@addBlog')->name('addBlog')->middleware('auth');
Route::get('/admin/blog-list','BlogController@blogList')->name('blogList')->middleware('auth');
Route::get('/admin/users-list','BlogController@usersList')->name('usersList')->middleware('auth');
Route::post('/admin/saveBlog','BlogController@saveBlog')->name('saveBlog')->middleware('auth');;
Route::get('/admin/categories','BlogController@categories')->name('categories')->middleware('auth');;
Route::get('/admin/add-category','BlogController@showAddCategoryForm')->name('addcategory')->middleware('auth');;
Route::post('/admin/saveCategory','BlogController@saveCategory')->name('saveCategory')->middleware('auth');;
Route::get('/admin/password-setting','AdminController@passwordSetting')->name('passwordSetting')->middleware('auth');;
Route::post('/admin/validateCurrentPassword','AdminController@validateCurrentPassword')->name('validateCurrentPassword')->middleware('auth');;

                /* edit & delete category routes */

Route::get('/admin/edit-category/{id}','CategoryController@editCategory')->name('editCategory')->middleware('auth');;
Route::get('/admin/delete-category/{id}','CategoryController@deleteCategory')->name('deleteCategory')->middleware('auth');;
Route::post('/admin/updateCategory','CategoryController@updateCategory')->name('updateCategory')->middleware('auth');;


                /* edit & delete blog routes */

Route::get('/admin/edit-blog/{id}','BlogController@editBlog')->name('editBlog')->middleware('auth');;
Route::get('/admin/delete-blog/{id}','BlogController@deleteBlog')->name('deleteBlog')->middleware('auth');;
Route::post('/admin/updateBlog','BlogController@updateBlog')->name('updateBlog')->middleware('auth');;

                    /* forum activity routes */
Route::get('/admin/forum','ForumController@index')->name('forum')->middleware('auth');;
Route::get('/admin/forum-detail/{id}/{slug}','ForumController@detail')->name('detail')->middleware('auth');;
Route::post('/admin/saveComment','ForumController@saveComment')->name('saveComment')->middleware('auth');;
Route::post('/admin/getCommentsById','ForumController@getCommentsById')->middleware('auth');;
Route::post('/admin/doLike','ForumController@doLike')->middleware('auth');;

