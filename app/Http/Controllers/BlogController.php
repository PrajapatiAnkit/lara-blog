<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function addBlog()
    {
        return view('admin.addBlog');
    }

    public function blogList()
    {
        return view('admin.blogList');
    }

    public function usersList()
    {
        return view('admin.usersList');
    }
}
