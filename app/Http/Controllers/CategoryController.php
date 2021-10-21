<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // create
    public function create()
    {
        return view('categories.create');
    }
}
