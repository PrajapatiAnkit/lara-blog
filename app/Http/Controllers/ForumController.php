<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function index()
    {
        $blogsObj = new Blog();
        echo '<pre>';
        print_r($blogsObj->getAllBlogs()->toArray());die();

        return view('admin.forum',['blogs' => $blogsObj->getAllBlogs()]);
    }

    public function detail($id)
    {
        $blogsObj = new Blog();
       $blog = $blogsObj->getBlogById($id);
        return view('admin.forum_detail',['blog' => $blog]);
    }

    public function saveComment(Request $request)
    {
        $userId = Auth::id();
        $save = Comment::saveComment($request,$userId);
        $comments = Comment::getAllComments($userId,$request->input('blogId'));
        if ($save){
            return response()->json(['saved'=>1,'comments'=>$comments]);
        }else{
            return response()->json(['saved'=>0]);
        }
    }
    public function getCommentsById(Request $request)
    {
        $blogId = $request->input('blogId');
        $comments = Comment::getAllComments(Auth::id(),$request->input('blogId'));
        if ($comments){
            return response()->json(['comments'=>$comments]);
        }
    }
}
