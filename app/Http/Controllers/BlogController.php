<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Categories;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ValidationRequestClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        if (!empty($request->file('blogImage'))){
            $image = $request->file('blogImage');
            $newImageName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/uploads'),$newImageName);
        }else{
            $newImageName = '';
        }

        $blog->blog_images = $newImageName;
        $blog->blog_slug = $this->slugify($request->input('blogTitle'));
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

    public function saveCategory(CategoryRequest $request)
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

    public function editBlog($id)
    {
        $blog = Blog::find($id);
        $categories = Categories::all();
        return view('admin.editBlog',['blog' => $blog,'categories'=>$categories]);
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blogList')->with('message','Blog deleted !');
    }

    public function updateBlog(BlogRequest $request)
    {
        $preImage = $request->input('preImage');
        if ($preImage !=''){
            Storage::delete(public_path('assets/uploads'.$preImage));
        }

        $newBlogImage = $request->file('blogImage');
       // print_r($newBlogImage);die();

        $newImageName = rand() . '.' . $newBlogImage->getClientOriginalExtension();

        $newBlogImage->move(public_path('assets/uploads'),$newBlogImage);

        $blog = Blog::find($request->input('blogEditId'));
        $blog->blog_title = $request->input('blogTitle');
        $blog->blog_category = $request->input('blogCategory');
        $blog->blog_description = $request->input('blogDescription');
        $blog->blog_images = $newImageName;
        $blog->blog_slug = $this->slugify($request->input('blogTitle'));

        $blog->added_by = Auth::id();
        if ($blog->save()){
            return redirect()->route('blogList')->with('message','Blog updated !');
        }

    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
