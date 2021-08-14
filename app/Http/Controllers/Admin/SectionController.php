<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('backend.sections.index', compact('sections'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request, Section $section)
    {
        //
    }

    public function destroy(Section $section)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        // dd($request->status);
        $status = 1 - $request->status;
        // dd($status);
        Section::where('id', $request->section_id)->update(['status' => $status]);
        return response()->json(['status' => $status, 'section_id' => $request->section_id]);
    }
}
