<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    //
    public function index()
    {
        $blogsObj = new Blog();

        return view('admin.forum',['blogs' => $blogsObj->getAllBlogs()]);
    }

    public function detail()
    {
        return view('admin.forum_detail');
    }

    public function saveComment(Request $request)
    {

    }
}
