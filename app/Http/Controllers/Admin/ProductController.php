<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Section;
use App\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.products.index');
    }

    public function create()
    {
        $sections = Section::get();
        return view('backend.products.create', compact('sections'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        // dd($request->product_id);
        $status = 1 - $request->status;
        // dd($status);
        Product::where('id', $request->product_id)->update(['status' => $status]);
        return response()->json(['status' => $status, 'product_id' => $request->product_id]);
    }
    
    public function ssd()
    {
        $products = Product::query();
        return Datatables::of($products)
                ->editColumn('status', function($product){
                    if ($product->status == '1') {
                        $status = '<div id="status_label_'.$product->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$product->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$product->id.'" checked
                                    product_id="'.$product->id.'">
                                        <label class="custom-control-label" id="product_'.$product->id.'"
                                        for="customSwitch'.$product->id.'">Active</label>
                                </div>';
                    }else{
                        $status = '<div id="status_label_'.$product->id.'" class="custom-control custom-switch">
                                    <input type="checkbox" status="'.$product->status.'"
                                    class="update_status_toggler custom-control-input"
                                    id="customSwitch'.$product->id.'" product_id="'.$product->id.'">
                                        <label class="custom-control-label" id="product_'.$product->id.'"
                                        for="customSwitch'.$product->id.'">Inactive</label>
                                    </div>';
                    };
                    return $status;
                })
                ->editColumn('category_id', function($product){
                    if ($product->category->status != 1) {
                        $category_name = "<span>".$product->category->name."</span><small class='mx-1 px-1 
                                         rounded-pill bg-danger text-white font-weight-bold'>Inactive</small>";
                    }else{
                        $category_name = $product->category->name;
                    }
                    return $category_name;
                })
                ->editColumn('section_id', function($product){
                    if ($product->section->status != 1) {
                        $section_name = "<span>".$product->section->name."</span><small class='mx-1 px-1 
                                         rounded-pill bg-danger text-white font-weight-bold'>Inactive</small>";
                    }else{
                        $section_name = $product->section->name;
                    }
                    return $section_name;
                })
                ->editColumn('subcategory_id', function($product){
                    if ($product->subcategory->status != 1) {
                        $subcategory_name = "<span>".$product->subcategory->name."</span><small class='mx-1 px-1 
                                         rounded-pill bg-danger text-white font-weight-bold'>Inactive</small>";
                    }else{
                        $subcategory_name = $product->subcategory->name;
                    }
                    return $subcategory_name;
                })
                ->editColumn('image', function($product){
                        $image_path = asset('storage/'.$product->image);
                        $image = '<img src="'.$image_path.'" alt="product-img" width="80px">';
                        return $image;
                })
                ->editColumn('action', function($product){
                    $action = '<a href="/admin/products/'.$product->id.'" class="btn btn-info px-2 py-1">
                                <i class="metismenu-icon pe-7s-keypad text-dark"></i>
                                </a>
                                <a href="/admin/products/'.$product->id.'/edit" class="btn btn-warning px-2 py-1">
                                <i class="metismenu-icon pe-7s-config text-dark"></i>
                                </a>
                                <a class="delete_btn btn btn-danger px-2 py-1" href="#" data-id='.$product->id.'>
                                <i class="metismenu-icon pe-7s-trash text-dark"></i>
                                </a>';
                                
                    return $action;
                })
                ->removeColumn('id')
                ->rawColumns(['status', 'category_id', 'section_id', 'subcategory_id', 'image', 'action'])
                ->make(true);
    }

    public function getRelatedSubcategory(Request $request)
    {
        $category_id = $request->category_id;
        $subcategories = Subcategory::where('category_id', $category_id)->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
}
