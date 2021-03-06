<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Product;
use App\Product_image;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait; // sử dụng trait chỉ cần use
    private $category;
    private $product;
    private $product_image;
    public function __construct(Category $category, Product $product, Product_image $product_image)
    {
        $this->category = $category;
        $this->product = $product;
        $this->product_image = $product_image;
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
        try {
            DB::beginTransaction();
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

            $product = $this->product->create($productItem);

            //inrset product_images
            // check xem cái input name image_path
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $itemImage) {
                    $dataUploadFileImage = $this->storageTraitUploadMulti($itemImage, 'products');
                    // c1: sử dụng đến product_images
                    // $this->product_image->create([
                    //     'product_id' => $product->id,
                    //     'image_path' => $dataUploadFileImage['image_path'],
                    //     'image_name' => $dataUploadFileImage['image_name'],
                    // ]);

                    // c2: sử dung eloquent tao liên kêt Product với Product_images
                    $product->images()->create([
                        'product_id' => $product->id,
                        'image_path' => $dataUploadFileImage['image_path'],
                        'image_name' => $dataUploadFileImage['image_name'],
                    ]);
                }
            }

            // Inrset Product_tags
            if (!empty($request->tags)) {
                foreach ($request->tags as $itemTag) {
                    $dataTag = Tag::firstOrCreate(['name' => $itemTag]);
                    $tagId[] = $dataTag->id;
                }
                $product->tags()->attach($tagId);
            }

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $error) {
            Log::error('Message: ' . $error->getMessage() . '--- Line: ' . $error->getLine());
            DB::rollBack();
        }
    }

    // edit
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategoryProduct($product->category_id);
        return view('admin.products.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            // data truyen vao
            $productItemUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
                'slug' => str_slug($request->name)
            ];

            // update img đại diện
            $dataImageUpdateTrait = $this->storageTraitUpload($request, 'feature_image_path', 'products');
            if (!empty($dataImageUpdateTrait)) {
                $productItemUpdate['feature_image_path'] = $dataImageUpdateTrait['file_path'];
                $productItemUpdate['feature_image_name'] = $dataImageUpdateTrait['file_name'];
            }

            $this->product->find($id)->update($productItemUpdate);
            $product = $this->product->find($id);

            // update Product_images
            if ($request->hasFile('image_path')) {
                // Xóa hết ảnh đi 
                $this->product_image->where('product_id', $id)->delete();
                foreach ($request->image_path as $itemImages) {
                    $dataImageUpdateMulti = $this->storageTraitUploadMulti($itemImages, 'products');

                    $product->images()->create([
                        'image_path' => $dataImageUpdateMulti['image_path'],
                        'image_name' => $dataImageUpdateMulti['image_name'],
                    ]);
                }
            }

            // Inrset Product_tags
            if (!empty($request->tags)) {
                // $product->tags()->detach();

                foreach ($request->tags as $itemTag) {
                    $dataTag = Tag::firstOrCreate(['name' => $itemTag]);
                    $tagId[] = $dataTag->id;
                }
                $product->tags()->sync($tagId);
            }

            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $error) {
            Log::error('Message: ' . $error->getMessage() . '--- Line: ' . $error->getLine());
            DB::rollBack();
        }
    }

    // delete
    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Success'
            ], 200);
            // return redirect()->route('products.index');
        } catch (\Exception $error) {
            Log::error('Message: ' . $error->getMessage() . '--- Line: ' . $error->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Fail'
            ], 500);
        }
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
