<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait; // sử dụng trait chỉ cần use
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
    public function store(Request $request)
    {
        // $path = $request->file('feature_image_path')->store('products'); // Auto đặt name img

        // Thưc hiện giữ nguyên ảnh ban đầu
        $data = $this->storageTraitUpload($request, 'feature_image_path', 'products');

        dd($data);
        // return $path;
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
