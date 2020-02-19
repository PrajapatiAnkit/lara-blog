<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * ==============================================================
     * This controller performs the edit,delete and update the category
     */


    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @todo it edits the category
     */
    public function editCategory($categoryId)
    {
        $categoryObj = new Categories();
        $category =  $categoryObj->getCategoryById($categoryId);
        return view('admin.editcategory',['category'=>$category]);
    }

    /**
     * @todo it updates the saved category
     * @param CategoryController $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCategory(CategoryRequest $request)
    {
        $validation = $request->validated();
        $category = Categories::find($request->input('categoryId'));
        $category->category_name = $request->input('categoryName');
        if ($category->save()){
            /**
             * if category saved the it will be redirected to categories page
             */
            return redirect()->route('categories')->with('message','Category Updated !!');
        }

    }

    /**
     * @todo it simply deleted the category
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCategory($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect()->route('categories')->with('message','Category deleted !');
    }
}
