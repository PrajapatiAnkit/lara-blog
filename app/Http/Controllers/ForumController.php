<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Like;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * ==============================================================
     * This controller performs to show the blog details and comments associated with it
     */


    /**
     * @todo it loades the forum timeline page where posts apear
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blogsObj = new Blog();
        return view('admin.forum',['blogs' => $blogsObj->getAllBlogs()]);
    }

    /**
     * @todo it finds blog detail in a separate page using blog id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $blogsObj = new Blog();
       $blog = $blogsObj->getBlogById($id);
        return view('admin.forum_detail',['blog' => $blog]);
    }

    /**
     * @todo it saves comment to the database and fetches all the latest comments
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveComment(Request $request)
    {
        $userId = Auth::id();
        $save = Comment::saveComment($request,$userId);
        /**
         * this function getAllComments fetches all the latest comments of particular blog
         */
        $comments = Comment::getAllComments($userId,$request->input('blogId'));
        if ($save){
            /**
             * if saved it returns all the latest comments to json
             */
            return response()->json(['saved'=>1,'comments'=>$comments]);
        }else{
            /**
             * it shows any error occurred
             */
            return response()->json(['saved'=>0]);
        }
    }

    /**
     * @todo this function get all the latest comment and return with json response
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentsById(Request $request)
    {
        $blogId = $request->input('blogId');
        $comments = Comment::getAllComments(Auth::id(),$request->input('blogId'));
        if ($comments){
            /**
             * if comments found with associated blog id,return that comment in json format
             */
            return response()->json(['comments'=>$comments]);
        }
    }

    public function doLike(Request $request)
    {
        $save = Like::saveLike($request,Auth::id());
        if ($save){
            return response()->json(['liked'=>'yes']);
        }
    }
}
