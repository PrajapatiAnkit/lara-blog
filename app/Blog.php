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
        $query = DB::table('lara_blogs')
            ->join('lara_categories','lara_blogs.blog_category','=','lara_categories.id')
            ->join('lara_users','lara_blogs.added_by','=','lara_users.id')
            ->select('lara_blogs.*','lara_categories.category_name','lara_users.username')
            ->get();
        return $query;
    }

}
