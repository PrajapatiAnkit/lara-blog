<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * it is a table name
     * @var string
     */
    protected $table = 'categories';

    /**
     * it finds all the categories from the database
     * @return Categories[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        $query = Self::all();
        return $query;
    }

    /**
     * finds the particular category by its id
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id)
    {
        $query = Self::where('id',$id)->first();
        return $query;
    }

    /**
     * it deleted the category
     */
    public function deleteCategory()
    {


    }
}
