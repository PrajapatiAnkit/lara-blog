<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    /*
     * here we defined the table name and fillable
     */
    protected $table = 'like_dislikes';
    protected $fillable = ['blog_id','user_id','status'];

    /**
     * @todo this checks if user liked
     * @param $blogId
     * @param $userId
     * @return bool
     */
    public static function checkIfUserLiked($blogId,$userId)
    {
        $usersLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>1])->first();
        if ($usersLiked){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @todo this function saves the like
     * @param $blogId
     * @param $userId
     * @return mixed
     */
    public static function saveLike($blogId,$userId)
    {
        $query = Self::create(
            [
                'blog_id' => $blogId,
                'user_id' => $userId,
                'status' =>1
            ]
        );
        return $query;
    }

    /**
     * @todo this function removes the like
     * @param $blogId
     * @param $userId
     * @return mixed
     */
    public static function removeLike($blogId,$userId)
    {
        $like = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>1]);
        return $like->delete();
    }

    /**
     * @todo check if user already disliked the post
     * @param $blogId
     * @param $userId
     * @return bool
     */
    public static function checkIfUserDisLiked($blogId,$userId)
    {
        $usersDisLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>0])->first();
        if ($usersDisLiked){
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function saves the dislike
     * @param $blogId
     * @param $userId
     * @return mixed
     */
    public static function saveDisLike($blogId,$userId)
    {
        $query = Self::create(
            [
                'blog_id' => $blogId,
                'user_id' => $userId,
                'status' =>0
            ]
        );
        return $query;
    }

    /**
     * @todo Removes the dislike
     * @param $blogId
     * @param $userId
     * @return mixed
     */
    public static function removeDisLike($blogId,$userId)
    {
        $like = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>0]);
        return $like->delete();
    }

    public function likeDislikeStatus()
    {
        return $this->belongsTo('App\Blog','user_id');
    }

}
