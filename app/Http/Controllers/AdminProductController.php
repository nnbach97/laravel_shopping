<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    // index
    public function index()
    {
        // $listProducts = [];
        return view('admin.products.index');
    }

    // create
    public function create()
    {
        $htmlOption = $this->getCategoryProduct('');
        return view('admin.products.create', compact('htmlOption'));
    }

    // store
    public function store()
    {
        dd('store');
    }

    // edit
    public function edit($id)
    {
        return view('admin.products.index');
    }

    // delete
    public function delete($id)
    {
        return view('admin.products.index');
    }

    // Get Category Product
    public function getCategoryProduct($id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->checkCategoryParent($id);
        return $htmlOption;
    }
}
