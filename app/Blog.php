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
    public static function getAllBlogs()
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


    /**
     * This function returns the total like count
     * @param $blogId
     * @return mixed
     */
    public static function getLikeCountByBlog($blogId)
    {
        $totalLikeCount  = Self::select('like_count')->where(['id'=>$blogId])->first();
        return $totalLikeCount->like_count;
    }

    /**
     * @todo This function returns the dislikes of the post
     * @param $blogId
     * @return mixed
     */
    public static function getDislikeCountByBlog($blogId)
    {
        $totalDisLikeCount  = Self::select('dislike_count')->where(['id'=>$blogId])->first();
        return $totalDisLikeCount->dislike_count;
    }

    /**
     * @todo This function updates the new likes and dislikes of the post
     * @param $blogId
     * @param $newLikeCount
     * @param $newDislikeCount
     * @return mixed
     */
    public static function updateNewLikeDislikeCount($blogId,$newLikeCount,$newDislikeCount)
    {

        $updated = Self::where(['id'=>$blogId])->update([
            'like_count'=>$newLikeCount,
            'dislike_count'=>$newDislikeCount,
        ]);
        return $updated;
    }


    /**
     * @todo returns comments count of the particular blog
     * @param $blogId
     * @return mixed
     */
    public static function getCommentCount($blogId)
    {
        $getPreviousComments  = Self::select('comment_count')->where(['id'=>$blogId])->first();
        return $getPreviousComments->comment_count;

    }

    /**
     * @todo This function update the comment of post
     * @param $blogId
     * @param $commentCount
     * @return mixed
     */
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
