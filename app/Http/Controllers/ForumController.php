<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\DisLike;
use App\Like;
use App\LikeDislike;
use DemeterChain\B;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
        $likeDislike = LikeDislike::with('likeDislikeStatus')->get();
        return view('admin.forum',['blogs' => Blog::getAllBlogs(),'likeDislike'=>$likeDislike]);
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
     //  print_r($blog);die();
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

    /**
     * @todo This function deletes the comment of the blog
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment(Request $request)
    {
        $commentId = $request->input('commentId');
        $blogId = $request->input('blogId');
        $userId = Auth::id();
        $delete = Comment::deleteComment($userId,$commentId,$blogId);
        if ($delete){
            return response()->json(['deleted'=>1]);
        }
    }


    /**
     * @todo This function performs the like dislike operation
     * on particular blog post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doLikeDislike(Request $request)
    {
        $userId = Auth::id();
        $blogId = $request->input('blogId');
        $action = $request->input('action');

        $checkLiked = LikeDislike::checkIfUserLiked($blogId,Auth::id());
        $checkDisLiked = LikeDislike::checkIfUserDisLiked($blogId,Auth::id());

        $likeCount = Blog::getLikeCountByBlog($blogId);
        $disLikeCount = Blog::getDislikeCountByBlog($blogId);

        if ($action == 'like'){
            if ($checkLiked){
                /**
                 * if user already liked the post
                 */
                $again = 'againLike';
                LikeDislike::removeLike($blogId,$userId);
                $newLikeCount = (($likeCount!=0?$likeCount-1:$likeCount));
                $newDislikeCount = $disLikeCount;
            }
            else if ($checkDisLiked && !$checkLiked){
                /**
                 * If user already disliked  but not liked the post
                 */
                $again = 'firstLike';
                LikeDislike::removeDisLike($blogId,$userId);
                LikeDislike::saveLike($blogId,$userId);

                $newDislikeCount = (($disLikeCount!=0?$disLikeCount-1:$disLikeCount));
                $newLikeCount = $likeCount+1;

            }else if (!$checkLiked && !$checkDisLiked){
                /**
                 * If user did not performed like of dislike till now
                 * but likes the post first time
                 */
                $again = 'firstLike';
                LikeDislike::saveLike($blogId,$userId);
                $newLikeCount = $likeCount+1;
                $newDislikeCount = $disLikeCount;
            }
        }else if ($action == 'dislike'){
            if ($checkDisLiked){
                /**
                 * If user already disliked the post
                 */
                $again = 'againDislike';
                LikeDislike::removeDisLike($blogId,$userId);

                $newDislikeCount = (($disLikeCount!=0?$disLikeCount-1:$disLikeCount));
                $newLikeCount = $likeCount;
            }else if ($checkLiked && !$checkDisLiked){
                /**
                 * If user already liked but did not disliked the post
                 */
                $again = 'firstDislike';
                LikeDislike::removeLike($blogId,$userId);
                LikeDislike::saveDisLike($blogId,$userId);

                $newLikeCount = (($likeCount!=0?$likeCount-1:$likeCount));
                $newDislikeCount = $disLikeCount+1;

            }else if (!$checkLiked && !$checkDisLiked){
                /**
                 * User neither liked nor disliked the post
                 *but doing first time dislike
                 */
                $again = 'firstDislike';
                LikeDislike::saveDisLike($blogId,$userId);
                $newDislikeCount = $disLikeCount+1;
                $newLikeCount = $likeCount;
            }
        }
        /**
         * finally update the new likes and dislikes count against that blog
         */
        $update = Blog::updateNewLikeDislikeCount($blogId,$newLikeCount,$newDislikeCount);
        if ($update){
            /**
             * And returnt the response in json format
             */
            return response()->json([
                'action'=>$action,
                'again' => $again,
                'likeCount'=>$newLikeCount,
                'disLikeCount'=>$newDislikeCount
            ]);
        }
    }
}
