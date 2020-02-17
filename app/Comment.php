<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Self_;

class Comment extends Model
{
    /**
     * this is a table
     * @var string
     */
    protected $table = 'comments';
    /**
     * this indicates the columns names of the table 'lara_comments'  to be filled
     * @var array
     */
    protected $fillable = ['blog_id','comment','userId'];

    /**
     * it saves all the comment against blog id
     * @param $request
     * @param $userId
     * @return mixed
     */
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

    /**
     * it finds all the comments associated with particular blog id
     * @param $userId
     * @param $blogId
     * @return mixed
     */
   public static function getAllComments($userId,$blogId)
   {
      $query = Self::where(['blog_id'=>$blogId,'userId'=>$userId])->orderBy('id','DESC')->get();
       return $query;
   }

    /**
     * this is belongs to relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   public function user()
   {
       return $this->belongsTo(Admin::class);
   }


}
