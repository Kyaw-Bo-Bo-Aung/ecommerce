<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('backend.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Subcategory $subcategory)
    {
        //
    }

    public function edit(Subcategory $subcategory)
    {
        //
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    public function destroy(Subcategory $subcategory)
    {
        //
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
                ->removeColumn('id')
                ->rawColumns(['status'])
                ->make(true);
    }
}
