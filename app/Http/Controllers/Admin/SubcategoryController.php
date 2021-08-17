<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubcategoryRequest;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('backend.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        $sections = Section::all();
        return view('backend.subcategories.create', compact('categories', 'sections'));
    }

    public function store(CreateSubcategoryRequest $request)
    {
        // dd($request->all());
        if (!$request->hasFile('image')) {
            $path = ''; 
        }else{
            $image = $request->file('image');
            if ($image->isValid()) {
                $image_name = uniqid().'_'.$image->getClientOriginalName();
                // dd($new_photo_name);
                $path = $image->storeAs('backend/admin/subcategories', $image_name, 'public');
            }
        }    
        $data = $request->all();
        $data['image'] = $path;
        Subcategory::create($data);
        return redirect()->route('admin.subcategories.index')
            ->with('status', 'New subcategory created successfully');
    }

    public function show(Subcategory $subcategory)
    {
        return view('backend.subcategories.show', ['subcategory' => $subcategory]);
    }

    public function edit(Subcategory $subcategory)
    {
        return view('backend.subcategories.edit');
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
    }

    public function updateStatus(Request $request)
    {
        // dd($request->subcategory_id);
        $status = 1 - $request->status;
        // dd($status);
        Subcategory::where('id', $request->subcategory_id)->update(['status' => $status]);
        return response()->json(['status' => $status, 'subcategory_id' => $request->subcategory_id]);
    }
    
    public function ssd()
    {
        $subcategories = Subcategory::query();
        // dd($subcategories);
        return Datatables::of($subcategories)
                ->editColumn('status', function($subcategory){
                    if ($subcategory->status == '1') {
                        $status = '<div id="status_label_'.$subcategory->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$subcategory->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$subcategory->id.'" checked
                                    subcategory_id="'.$subcategory->id.'">
                                        <label class="custom-control-label" id="subcategory_'.$subcategory->id.'"
                                        for="customSwitch'.$subcategory->id.'">Active</label>
                                </div>';
                    }else{
                        $status = '<div id="status_label_'.$subcategory->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$subcategory->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$subcategory->id.'" subcategory_id="'.$subcategory->id.'">
                                        <label class="custom-control-label" id="subcategory_'.$subcategory->id.'"
                                        for="customSwitch'.$subcategory->id.'">Inactive</label>
                                    </div>';
                    };
                    return $status;
                })
                ->editColumn('category_id', function($subcategory){
                    $category = Category::where('id', $subcategory->category_id)
                                        ->first();
                    if ($category->status != 1) {
                        $category_name = "<span>".$category->name."</span><small class='mx-1 px-1 
                                            rounded-pill bg-danger text-white font-weight-bold'>Inactive</small>"; 
                    }else{
                        $category_name = $category->name;
                    }
                    return $category_name;
                })
                ->editColumn('section_id', function($subcategory){
                    $section = Section::where('id', $subcategory->section_id)->first();
                    if ($section->status != 1) {
                        $section_name = "<span>".$section->name."</span><small class='mx-1 px-1 
                                            rounded-pill bg-danger text-white font-weight-bold'>Inactive</small>"; 
                    }else{
                        $section_name = $section->name;
                    }
                    return $section_name;
                })
                ->editColumn('action', function($subcategory){
                    $action = '<a href="/admin/subcategories/'.$subcategory->id.'" class="btn btn-info px-2 py-1">
                                <i class="metismenu-icon pe-7s-keypad text-dark"></i>
                                </a>
                                <a href="/admin/subcategories/'.$subcategory->id.'/edit" class="btn btn-warning px-2 py-1">
                                <i class="metismenu-icon pe-7s-config text-dark"></i>
                                </a>
                                <a class="delete_btn btn btn-danger px-2 py-1" href="#" data-id='.$subcategory->id.'>
                                <i class="metismenu-icon pe-7s-trash text-dark"></i>
                                </a>';
                                
                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['status', 'category_id', 'section_id', 'action'])
                ->make(true);
    }
}
