<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\DisLike;
use App\Like;
use DemeterChain\B;
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

        $newCommentsCount  = Blog::getCommentCount($request->input('blogId'))+1;
        $updateCommentCount = Blog::updateNewCommentCount($request->input('blogId'),$newCommentsCount);

        $save = Comment::saveComment($request,$userId);
        /**
         * this function getAllComments fetches all the latest comments of particular blog
         */
        $comments = Comment::getAllComments($userId,$request->input('blogId'));
        if ($save){
            /**
             * if saved it returns all the latest comments to json
             */
            return response()->json(['saved'=>1,'comments'=>$comments,'commentCount'=>$newCommentsCount]);
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

        $action = $request->input('action');
        $checkLiked = Like::checkIfUserLiked($request->input('blogId'),Auth::id());
        $checkDisLiked = DisLike::checkIfUserDisLiked($request->input('blogId'),Auth::id());

        $likeCount = Blog::getLikeCountByBlog($request->input('blogId'));
        $disLikeCount = Blog::getDislikeCountByBlog($request->input('blogId'));

        if ($action == 'like'){
            if ($checkLiked){
                $again = 'againLike';
                $likeCount = (($likeCount!=0?$likeCount-1:$likeCount));
                Like::removeLike($request->input('blogId'),Auth::id());
            }else{
                $again = 'firstLike';
                $likeCount = $likeCount+1;
                $disLikeCount = (($disLikeCount!=0?$disLikeCount-1:$disLikeCount));
                Like::saveLike($request,Auth::id());
            }

        }else if ($action == 'dislike'){
            if ($checkDisLiked){
                $again = 'againDislike';
                $disLikeCount = (($likeCount!=0?$likeCount-1:$likeCount));
                DisLike::removeDisLike($request->input('blogId'),Auth::id());
            }else{
                $again = 'firstDislike';
                $disLikeCount = $disLikeCount+1;
                DisLike::saveDisLike($request->input('blogId'),Auth::id());
            }
        }

      /* echo $likeCount.'<br/>';
      echo $disLikeCount.'<br/>';
      die();*/

         $updateNewLiked = Blog::updateNewLikeDislikeUsers($request->input('blogId'),$likeCount,$disLikeCount,Auth::id(),$action);

        if ($updateNewLiked){
                return response()->json([
                    'action'=>$action,
                    'again' => $again,
                    'likeCount'=>$likeCount,
                    'disLikeCount'=>$disLikeCount
                ]);
        }
    }
}
