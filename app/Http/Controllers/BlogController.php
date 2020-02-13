<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Categories;
use App\Http\Requests\ValidationRequestClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    public function addBlog()
    {
        $categories = Categories::all();
        return view('admin.addBlog',['categories'=>$categories]);
    }

    public function saveBlog(ValidationRequestClass $request)
    {
        $validattion = $request->validated();
        $blog = new Blog();
        $blog->blog_title = $request->input('blogTitle');
        $blog->blog_category = $request->input('blogCategory');
        $blog->blog_description = $request->input('blogDescription');
        $blog->added_by = Auth::id();
        $save = $blog->save();
        if ($save){
            return response()->json(['status' => '1', 'message' => 'New Blog Added']);
        }else{
            return response()->json(['status' => '0', 'message' => 'Error occured !']);
        }
    }

    public function categories()
    {
        $categoryObj = new Categories();
        $categories = $categoryObj->getAllCategories();
        return view('admin.categories',['category'=>$categories]);
    }

    public function showAddCategoryForm()
    {

        return view('admin.addcategory');
    }

    public function saveCategory(ValidationRequestClass $request)
    {
        $validation = $request->validated();
        $categories = new Categories();
        $categories->category_name = $request->input('categoryName');
        $saveCategory = $categories->save();
        if ($saveCategory){
            return redirect()->route('categories')->with('message','Category Added !!');
        }


    }

    public function blogList()
    {
        $blog = new Blog();
        $allBlogs = $blog->getAllBlogs();
        return view('admin.blogList',['blogs'=>$allBlogs]);
    }


    public function usersList()
    {
        return view('admin.usersList');
    }
}
