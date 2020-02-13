<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'lara_categories';

    public function getAllCategories()
    {
        $query = Self::all();
        return $query;
    }
}
