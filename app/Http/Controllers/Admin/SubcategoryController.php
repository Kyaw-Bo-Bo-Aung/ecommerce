<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('backend.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $sections = Section::where('status', 1)->get();
        return view('backend.subcategories.create', compact('categories', 'sections'));
    }

    public function store(CreateSubcategoryRequest $request)
    {
        // return $request->all();
        if (!$request->hasFile('image')) {
            $path = ''; 
        }else{
            $image = $request->file('image');
            if ($image->isValid()) {
                $image_name = uniqid().'_'.$image->getClientOriginalName();
                // dd($new_photo_name);
                $path = $image->storeAs('backend/subcategories', $image_name, 'public');
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
        $subcategory->load('category', 'section');
        $categories = Category::get();
        $sections = Section::get();
        return view('backend.subcategories.edit', compact('subcategory', 'categories', 'sections'));
    }

    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        // dd($request->all());
        if (!$request->hasFile('new_image')) {
            $path = $request->current_image ?? ''; 
        }else{
            $new_image = $request->file('new_image');
            if ($new_image->isValid()) {
                $new_image_name = uniqid().'_'.$new_image->getClientOriginalName();
                // dd($new_photo_name);
                $path = $new_image->storeAs('backend/subcategories', $new_image_name, 'public');
                Storage::disk('public')->delete($request->current_image);
            }
        }    

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->image = $path;
        $subcategory->discount = $request->discount;
        $subcategory->description = $request->description;
        $subcategory->url = $request->url;
        $subcategory->meta_title = $request->meta_title;
        $subcategory->meta_description = $request->meta_description;
        $subcategory->meta_keywords = $request->meta_keywords;
        $subcategory->update();

        return redirect()->route('admin.subcategories.index')
                        ->with('status', 'Subcategory is updated successfully');
    }

    public function destroy(Subcategory $subcategory)
    {
        Storage::disk('public')->delete($subcategory->image);
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
                ->rawColumns(['status', 'category_id', 'action'])
                ->make(true);
    }
}
