<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisLike extends Model
{
    //
    protected $table = 'dislike';
    public $timestamps = false;
    protected $fillable = ['blog_id','user_id','dislike_value'];

    public static function checkIfUserDisLiked($blogId,$userId)
    {
        $usersDisLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId])->first();
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
                'dislike_value' =>1
            ]
        );
        return $query;
    }

    public static function removeDisLike($blogId,$userId)
    {
        $like = Self::where(['blog_id'=>$blogId,'user_id'=>$userId]);
        return $like->delete();
    }
}
