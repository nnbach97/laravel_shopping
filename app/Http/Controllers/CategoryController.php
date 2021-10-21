<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // List
    public function index()
    {
        return view('categories.index');
    }

    // create
    public function create()
    {
        return view('categories.create');
    }
}
