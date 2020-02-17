<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Blog extends Model
{
    //
    protected $table = 'lara_blogs';

    public function getAllBlogs()
    {
        $query = self::with('comments')
            ->join('lara_categories','lara_blogs.blog_category','=','lara_categories.id')
            ->join('lara_users','lara_blogs.added_by','=','lara_users.id')
            ->select('lara_blogs.*','lara_categories.category_name','lara_users.username')
            ->get();
        return $query;
    }

    public function getBlogById($id)
    {
        $query = Self::find($id);
        return $query;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','blog_id','id')
            ->orderBy('id','DESC')
            ->limit(2);
    }

}
