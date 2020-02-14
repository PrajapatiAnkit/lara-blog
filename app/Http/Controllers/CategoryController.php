<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function editCategory($categoryId)
    {
        $categoryObj = new Categories();
        $category =  $categoryObj->getCategoryById($categoryId);
        return view('admin.editcategory',['category'=>$category]);
    }

    public function updateCategory(CategoryController $request)
    {
        $validation = $request->validated();
        $category = Categories::find($request->input('categoryId'));
        $category->category_name = $request->input('categoryName');
        if ($category->save()){
            return redirect()->route('categories')->with('message','Category Updated !!');
        }

    }

    public function deleteCategory($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->route('categories')->with('message','Category deleted !');
    }
}
