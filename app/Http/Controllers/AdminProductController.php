<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Product;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait; // sử dụng trait chỉ cần use
    private $category;
    private $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    // index
    public function index()
    {
        $listProducts = $this->product->latest()->paginate(5);
        return view('admin.products.index', compact('listProducts'));
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
        // data truyen vao
        $productItem = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'slug' => str_slug($request->name)
        ];

        // $path = $request->file('feature_image_path')->store('products'); // Auto đặt name img
        // Thưc hiện giữ nguyên ảnh ban đầu
        $dataUploadFile = $this->storageTraitUpload($request, 'feature_image_path', 'products');
        if (!empty($dataUploadFile)) {
            $productItem['feature_image_name'] = $dataUploadFile['file_name'];
            $productItem['feature_image_path'] = $dataUploadFile['file_path'];
        }

        $this->product->create($productItem);
        return redirect()->route('products.index');
    }

    // edit
    public function edit($id)
    {
        return redirect()->route('products.index');
    }

    // delete
    public function delete($id)
    {
        $this->product->find($id)->delete();
        return redirect()->route('products.index');
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
