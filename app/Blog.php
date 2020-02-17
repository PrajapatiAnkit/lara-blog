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
        $query = self::with(array('comments'=>function($query){
                $query->orderBy('id', 'DESC');
                $query->limit(2);
            }))
            ->join('categories','blogs.category_id','=','categories.id')
            ->join('users','blogs.added_by','=','users.id')
            ->select('blogs.*','categories.category_name','users.username')
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
     * returns the comment associated with particular blog
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment','blog_id','id');
    }

}
