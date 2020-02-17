<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Model
{
    /**
     * it is just a table name
     * @var string
     */
    protected $table = 'users';

}
