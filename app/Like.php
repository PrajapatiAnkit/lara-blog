<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Like extends Model
{
    //
    protected $table = 'likes';
    protected $fillable = ['blog_id','user_id','like_value'];

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
}
