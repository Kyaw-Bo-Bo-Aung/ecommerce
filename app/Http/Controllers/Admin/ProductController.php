<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Section;
use App\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;

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

    public function store(CreateProductRequest $request)
    {
        // dd($request);
        if (!$request->hasFile('image')) {
            $path = '';
        }else{
            $image = $request->file('image');
            if ($image->isValid()) {
                $image_name = uniqid().'_'.$image->getClientOriginalName();
                // dd($new_photo_name);
                $path = $image->storeAs('backend/products', $image_name, 'public');
            }
        }    
        $data = $request->all();
        $data['image'] = $path;
        Product::create($data);
        return redirect()->route('admin.products.index')
            ->with('status', 'New product created successfully');
    }

    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $sections = Section::all();
        return view('backend.products.edit', compact('product', 'sections'));
    }

    public function update(CreateProductRequest $request, Product $product)
    {
        // return ($request->all());
        if (!$request->hasFile('new_image')) {
            $path = $request->current_image ?? ''; 
        }else{
            $new_image = $request->file('new_image');
            if ($new_image->isValid()) {
                $new_image_name = uniqid().'_'.$new_image->getClientOriginalName();
                // dd($new_photo_name);
                $path = $new_image->storeAs('backend/products', $new_image_name, 'public');
                Storage::disk('public')->delete($request->current_image);
            }
        }
        $product->name = $request->name;
        $product->subcategory_id = $request->new_subcategory_id ?? $request->subcategory_id;
        $product->image = $path;
        $product->video = '';
        $product->code = $request->code;
        $product->feature = $request->feature;
        $product->discount = $request->discount;
        $product->color = $request->color;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->url = $request->url;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->update();

        return redirect()->route('admin.products.index')
                        ->with('status', 'Product is updated successfully');

    }

    public function destroy(Product $product)
    {
        $product->delete();
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
                    if ($product->image) {
                        $image_path = asset('storage/'.$product->image);
                        $image = '<img src="'.$image_path.'" alt="product-img" width="80px">';
                    }else{
                        $image = '<img src="https://ui-avatars.com/api/?name='.$product->name.'" alt="product-img" width="80px">';
                    }
                        
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
                ->rawColumns(['status', 'subcategory_id', 'image', 'action'])
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
