<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use phpDocumentor\Reflection\Types\Self_;

class Like extends Model
{
    /**
     * This $table is the table name
     * This $fillable contains the column name of the table to be filled
     * @var string
     */
    protected $table = 'likes';
    protected $fillable = ['blog_id','user_id','like_value'];

    /**
     * @todo saves the like to the database
     * @param $request
     * @param $userId
     * @return mixed
     */

    public static function checkIfUserLiked($blogId,$userId)
    {
        $usersLiked  = Self::where(['blog_id'=>$blogId,'user_id'=>$userId])->first();
        if ($usersLiked){
           return true;
        }else{
            return false;
        }
    }

    public static function saveLike($request,$userId)
    {
        $query = Self::create(
            [
                'blog_id' => $request->input('blogId'),
                'user_id' => $userId,
                'like_value' =>1
            ]
        );
        return $query;
    }

    public static function removeLike($blogId,$userId)
    {
        $like = Self::where(['blog_id'=>$blogId,'user_id'=>$userId]);
        return $like->delete();
    }

}
