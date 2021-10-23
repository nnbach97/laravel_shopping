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
        $listCategory = $this->category->latest()->paginate(5); // lấy ra các bản ghi mới nhất latest
        return view('categories.index', compact('listCategory'));
    }

    // create
    public function create()
    {
        // get Name Category
        $htmlOption = $this->getNameCategory(0);
        return view('categories.create', compact('htmlOption'));
    }

    //store
    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    //edit
    public function edit($id)
    {
        $dbItem = $this->category->find($id);
        $htmlOption = $this->getNameCategory($dbItem->parent_id);
        return view('categories.edit', compact('dbItem', 'htmlOption'));
    }

    //edit
    public function update($id, Request $request)
    {
        $dbItem = $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    //delete
    public function delete($id)
    {
        $this->category->where('id', $id)->delete();

        return redirect()->route('categories.index');
    }

    public function getNameCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->checkCategoryParent($parentId);

        return $htmlOption;
    }
}
