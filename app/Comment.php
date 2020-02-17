<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class Comment extends Model
{
    //
    protected $table = 'lara_comments';
    protected $fillable = ['blog_id','comment','userId'];

    public static function saveComment($request,$userId)
   {
       $saveQuery = Self::create([
                'comment' => $request->input('commentText'),
                'blog_id' => $request->input('blogId'),
                'userId' => $userId,
            ]
        );
        return $saveQuery;
   }

   public static function getAllComments($userId,$blogId)
   {
      $query = Self::where(['blog_id'=>$blogId,'userId'=>$userId])->orderBy('id','DESC')->get();
       return $query;
   }

   public function user()
   {
       return $this->belongsTo(Admin::class);
   }


}
