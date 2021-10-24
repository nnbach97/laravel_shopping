<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
    // list
    public function index()
    {
        $listMenu = $this->menu->latest()->paginate(5);
        return view('admin.menus.index', compact('listMenu'));
    }

    // create
    public function create()
    {
        $htmlOption = $this->getNameMenu('');
        return view('admin.menus.create', compact('htmlOption'));
    }

    // Store
    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('menus.index');
    }

    // edit
    public function edit($id)
    {
        $dbItem = $this->menu->find($id);
        $htmlOption = $this->getNameMenu($dbItem->parent_id);
        return view('admin.menus.edit', compact(['dbItem', 'htmlOption']));
    }

    // update
    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('menus.index');
    }

    // delete
    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }


    // Get Name Parent
    public function getNameMenu($parentId)
    {
        $data = $this->menu->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->checkCategoryParent($parentId);

        return $htmlOption;
    }
}
