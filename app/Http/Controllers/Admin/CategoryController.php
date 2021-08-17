<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255'
        ]);
        Category::create([
            'name' => $request->name
        ]);
        return redirect()->route('admin.categories.index')
                        ->with('status', 'New category created successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:2|max:255'
        ]);
        Category::where('id', $category->id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('admin.categories.index')
                        ->with('status', 'Category info updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }

    public function updateStatus(Request $request)
    {
        // dd($request->status);
        $status = 1 - $request->status;
        // dd($status);
        Category::where('id', $request->category_id)->update(['status' => $status]);
        return response()->json(['status' => $status, 'category_id' => $request->category_id]);
    }

    public function ssd()
    {
        $categories = Category::query();
        // dd($categories);
        return Datatables::of($categories)
                ->editColumn('status', function($category){
                    if ($category->status == '1') {
                        $status = '<div id="status_label_'.$category->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$category->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$category->id.'" checked
                                    category_id="'.$category->id.'">
                                        <label class="custom-control-label" id="category_'.$category->id.'"
                                        for="customSwitch'.$category->id.'">Active</label>
                                </div>';
                    }else{
                        $status = '<div id="status_label_'.$category->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$category->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$category->id.'" category_id="'.$category->id.'">
                                        <label class="custom-control-label" id="category_'.$category->id.'"
                                        for="customSwitch'.$category->id.'">Inactive</label>
                                    </div>';
                    };
                    return $status;
                })
                ->editColumn('action', function($category){
                    $action = '<a href="/admin/categories/'.$category->id.'/edit" class="btn btn-warning">
                                <i class="metismenu-icon pe-7s-config"></i>
                                </a>
                                <a class="delete_btn btn btn-danger" href="#" data-id='.$category->id.'>
                                <i class="metismenu-icon pe-7s-trash"></i>
                                </a>';
                                
                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['status', 'action'])
                ->make(true);
    }
}
