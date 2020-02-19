<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Blog extends Model
{
    /**
     * this is a table name
     * @var string
     */
    protected $table = 'blogs';

    /**
     * returns all the blog with his author and other details
     * @return Blog[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBlogs()
    {
       /* $query = self::with(array('comments'=>function($query){
                $query->orderBy('id', 'DESC');
                $query->limit(2);
            }))
            ->join('categories','blogs.category_id','=','categories.id')
            ->join('users','blogs.added_by','=','users.id')
            ->select('blogs.*','categories.category_name','users.username')
            ->get();
        return $query;*/
        $query = self::select('blogs.*','categories.category_name','users.username')
            ->join('categories','blogs.category_id','=','categories.id')
            ->join('users','blogs.added_by','=','users.id')
            ->orderBy('blogs.id','DESC')
            ->get();
        return $query;
    }

    /**
     * it finds particular blog detail via blog id
     * @param $id
     * @return mixed
     */
    public function getBlogById($id)
    {
        $query = Self::find($id);
        return $query;
    }



    public static function getLikeCountByBlog($blogId)
    {
        $totalLikeCount  = Self::select('like_count')->where(['id'=>$blogId])->first();
        return $totalLikeCount->like_count;
    }
    public static function getDislikeCountByBlog($blogId)
    {
        $totalDisLikeCount  = Self::select('dislike_count')->where(['id'=>$blogId])->first();
        return $totalDisLikeCount->dislike_count;
    }

    public static function updateNewLikeDislikeUsers($blogId,$newLikeCount,$newDislikeCount,$userId,$action)
    {

        $newLikedUsers = '';
        $newDislikedUsers = '';
        $oldLikedUsers  = Self::select('liked_by_users')->where(['id'=>$blogId])->first();
        $oldDisLikedUsers  = Self::select('disliked_by_users')->where(['id'=>$blogId])->first();

        if ($action == 'like'){

            /* means 1 st like */
            if (!in_array($userId,explode(',',$oldLikedUsers->liked_by_users))){
                $newLikedUsers = $oldLikedUsers->liked_by_users.','.$userId;
                $newLikedUsers = ltrim($newLikedUsers);
                $newLikedUsers = ltrim($newLikedUsers,',');
                $newLikedUsers = rtrim($newLikedUsers,',');
            }else{
                /* laredy liked, remove that like */
                $newLikedUsers = str_replace($userId,' ',$oldLikedUsers->liked_by_users);
                $newLikedUsers = trim($newLikedUsers);
                $newLikedUsers = ltrim($newLikedUsers,',');
                $newLikedUsers = rtrim($newLikedUsers,',');
            }


            if (in_array($userId,explode(',',$oldDisLikedUsers->disliked_by_users))){
                $newDislikedUsers = str_replace($userId,' ',$oldDisLikedUsers->disliked_by_users);
                $newDislikedUsers = trim($newDislikedUsers);
                $newDislikedUsers = ltrim($newDislikedUsers);
                $newDislikedUsers = rtrim($newDislikedUsers);
            }else{
                $newDislikedUsers = $oldDisLikedUsers->disliked_by_users;
            }

        }else{
            if (!in_array($userId,explode(',',$oldDisLikedUsers->disliked_by_users))){
               // echo 'here2';die();
                $newDislikedUsers = $oldDisLikedUsers->disliked_by_users.','.$userId;
                $newDislikedUsers = ltrim($newDislikedUsers,',');
                $newDislikedUsers = rtrim($newDislikedUsers,',');
           }else{
                $newDislikedUsers = str_replace($userId,' ',$oldDisLikedUsers->disliked_by_users);
                $newDislikedUsers = trim($newDislikedUsers);
                $newDislikedUsers = ltrim($newDislikedUsers,',');
                $newDislikedUsers = rtrim($newDislikedUsers,',');
            }
            if (in_array($userId,explode(',',$oldLikedUsers->liked_by_users))){
                $newLikedUsers = str_replace($userId,' ',$oldLikedUsers->liked_by_users);
                $newLikedUsers = trim($newLikedUsers);
                $newLikedUsers = ltrim($newLikedUsers);
                $newLikedUsers = rtrim($newLikedUsers);
            }else{
                $newLikedUsers = $oldLikedUsers->liked_by_users;
            }
        }
        $updated = Self::where(['id'=>$blogId])->update([
            'liked_by_users'=>$newLikedUsers,
            'disliked_by_users'=>$newDislikedUsers,
            'like_count'=>$newLikeCount,
            'dislike_count'=>$newDislikeCount,
        ]);
        return $updated;
    }



    public static function getCommentCount($blogId)
    {
        $getPreviousComments  = Self::select('comment_count')->where(['id'=>$blogId])->first();
        return $getPreviousComments->comment_count;

    }

    public static function updateNewCommentCount($blogId,$commentCount)
    {
        $query = Self::where(['id'=>$blogId])->update(['comment_count'=>$commentCount]);
        return $query;
    }

    /**
     * returns the comment associated with particular blog
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment','blog_id','id');
    }

}
