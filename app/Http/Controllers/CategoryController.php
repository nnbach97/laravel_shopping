<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    // List
    public function index()
    {
        return view('categories.index');
    }

    // create
    public function create()
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->checkCategoryParent();
        return view('categories.create', compact('htmlOption'));
    }
}
