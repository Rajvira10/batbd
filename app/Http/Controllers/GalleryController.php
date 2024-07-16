<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function admin(Request $request)
    {
        // if(!in_array('expense_categories.index', session('user_permissions')))
        // {
        //     return redirect()->route('admin-dashboard')->with('error', 'You are not authorized');
        // }

        $request->session()->now('view_name', 'admin.medias.index');
        
        if($request->ajax()){

            $galleries = Gallery::select(
                'id',
                'name',
                'status',
                'description'
            )
            ->orderBy('created_at', 'desc')
            ->get();

            return DataTables::of($galleries)

                ->addColumn('status', function($gallery){
                    if($gallery->status == 'active'){
                        return '<span class="badge bg-success" style="font-size: 13px">Active</span>';
                    }
                    else{
                        return '<span class="badge bg-danger" style="font-size: 13px">Inactive</span>';
                    }
                })

                ->addColumn('action', function ($gallery) {
                    $edit_button = '<div class="dropdown d-inline-block">
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">';

                    $edit_button .= '<li><a href="'.route('admin.medias', $gallery->id).'" class="dropdown-item">
                        <i class="ri-eye-fill pt-2 me-2"></i>Add Media</a></li>';

                    $edit_button .= '<li><a href="'.route('admin.galleries.edit', $gallery->id).'" class="dropdown-item">
                        <i class="ri-pencil-fill pt-2 me-2"></i>Edit</a></li>';

                    $edit_button .= '<li><button type="submit" class="dropdown-item delete-item-btn" onclick="deleteGallery(' . $gallery->id . ')">
                        <i class="ri-delete-bin-6-fill pt-2 me-2 text-danger"></i>Delete</button></li>';
                    return $edit_button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.gallery.index');
    }

    public function create(Request $request)
    {
        // if(!in_array('expense_categories.create', session('user_permissions')))
        // {
        //     return redirect()->route('admin-dashboard')->with('error', 'You are not authorized');
        // }
        $request->session()->now('view_name', 'admin.medias.index');

        return view('admin.gallery.create');
    }

    public function edit(Request $request, $gallery_id)
    {
        // if(!in_array('expense_categories.edit', session('user_permissions')))
        // {
        //     return redirect()->route('admin-dashboard')->with('error', 'You are not authorized');
        // }
        
        $request->session()->now('view_name', 'admin.medias.index');

        $gallery = Gallery::find($gallery_id);

        if($gallery != null){

            return view('admin.gallery.edit', compact('gallery'));
        }
        else{
            return redirect()->route('admin.galleries')->with('error', 'Gallery Not Found');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:galleries,name',
            'status' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $gallery = new Gallery();

        $gallery->name = $request->name;

        $gallery->status = $request->status;

        $gallery->description = $request->description;

        $gallery->save();

        return redirect()->route('admin.galleries')->with('success', 'Gallery Created Successfully');

    }

    public function update(Request $request, $gallery_id)
    {
        $request->validate([
            'name' => 'required|unique:galleries,name,'.$gallery_id,
            'status' => 'required|string',
            'description' => 'nullable|string'
        ]);
        
        $gallery = Gallery::find($gallery_id);

        if ($gallery != null) {

            $gallery->name = $request->name;

            $gallery->status = $request->status;

            $gallery->description = $request->description;

            $gallery->save();

            return redirect()->route('admin.galleries')->with('success', 'Gallery Updated Successfully');
        }
        else{
            return redirect()->route('admin.galleries')->with('error', 'Gallery Not Found');
        }
    }

    public function destroy(Request $request)
    {
        $gallery = Gallery::find($request->gallery_id);

        if($gallery != null){
            $gallery->delete();
            return response()->json(['success' => 'Gallery Deleted Successfully']);
        }
        else{
            return response()->json(['error' => 'Gallery Not Found']);
        }
    }

}
