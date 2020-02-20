<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeDislike extends Model
{
    protected $table = 'like_dislikes';
    protected $fillable = ['blog_id','user_id','status'];

    public static function checkIfUserLiked($blogId,$userId)
    {
        $usersLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>1])->first();
        if ($usersLiked){
            return true;
        }else{
            return false;
        }
    }

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

    public static function removeLike($blogId,$userId)
    {
        $like = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>1]);
        return $like->delete();
    }

    public static function checkIfUserDisLiked($blogId,$userId)
    {
        $usersDisLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId,'status'=>0])->first();
        if ($usersDisLiked){
            return true;
        }else{
            return false;
        }
    }

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
