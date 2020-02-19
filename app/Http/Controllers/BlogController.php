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
    /**
     * ==============================================================
     * This controller performs the save blog,edit,delete and lists blogs and category
     */


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @todo it fetches all the categories from database and passes them to view
     */
    public function addBlog()
    {
        $categories = Categories::all();
        return view('admin.addBlog',['categories'=>$categories]);
    }

    /**
     * @param ValidationRequestClass $request
     * @return \Illuminate\Http\JsonResponse
     * @todo It saves the blog to database
     */
    public function saveBlog(ValidationRequestClass $request)
    {

        $blog = new Blog();
        $blog->blog_title = $request->input('blogTitle');
        $blog->category_id = $request->input('blogCategory');
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
        $blog->like_status = 0;
        $blog->liked_by_users = '';
        $blog->blog_slug = $this->slugify($request->input('blogTitle'));
        $save = $blog->save();
        if ($save){
            /**
             * blog details has been saved
             */
            return response()->json(['status' => '1', 'message' => 'New Blog Added']);
        }else{
            /**
             * otherwise some error occurred
             */
            return response()->json(['status' => '0', 'message' => 'Error occured !']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @todo it fetches all the categories and passes to view
     */
    public function categories()
    {
        $categoryObj = new Categories();
        $categories = $categoryObj->getAllCategories();
        return view('admin.categories',['category'=>$categories]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddCategoryForm()
    {
        return view('admin.addcategory');
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @todo it takes category name input and saves to database
     */
    public function saveCategory(CategoryRequest $request)
    {
        $validation = $request->validated();
        $categories = new Categories();
        $categories->category_name = $request->input('categoryName');
        $saveCategory = $categories->save();
        if ($saveCategory){
            /**
             * if category saved,return success response with flash message
             */
            return redirect()->route('categories')->with('message','Category Added !!');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @todo this function finds all the blogs from database and passes them to view
     */
    public function blogList()
    {
        $blog = new Blog();
        $allBlogs = $blog->getAllBlogs();
        return view('admin.blogList',['blogs'=>$allBlogs]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersList()
    {
        return view('admin.usersList');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @todo finds the blog which is to be edited
     */
    public function editBlog($id)
    {
        $blog = Blog::find($id);
        //echo $blog->category_id;die();
        $categories = Categories::all();
        return view('admin.editBlog',['blog' => $blog,'categories'=>$categories]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @todo deleted the blog by id
     */
    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('blogList')->with('message','Blog deleted !');
    }

    /**
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @todo it updates the blog
     */
    public function updateBlog(BlogRequest $request)
    {
        $preImage = $request->input('preImage');
        if ($preImage !=''){
            Storage::delete(public_path('assets/uploads'.$preImage));
        }

        if (!empty($request->file('blogImage'))) {
            $newBlogImage = $request->file('blogImage');
            $newImageName = rand() . '.' . $newBlogImage->getClientOriginalExtension();
            $newBlogImage->move(public_path('assets/uploads'), $newBlogImage);
        }else{
            $newImageName = '';
        }

        $blog = Blog::find($request->input('blogEditId'));
        $blog->blog_title = $request->input('blogTitle');
        $blog->category_id = $request->input('blogCategory');
        $blog->blog_description = $request->input('blogDescription');
        $blog->blog_images = $newImageName;
        $blog->blog_slug = $this->slugify($request->input('blogTitle'));

        $blog->added_by = Auth::id();
        if ($blog->save()){
            /**
             * if blog details updated successfully
             */
            return redirect()->route('blogList')->with('message','Blog updated !');
        }

    }

    /**
     * @param $text
     * @return bool|false|string|string[]|null
     * @todo it simply generates slug of the blog title
     */
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
