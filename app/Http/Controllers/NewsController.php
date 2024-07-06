<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        $user = auth()->user();

        if ($request->filled('date')) {
            $query->whereDate('published_at', $request->date);
        }

        $news = $query->orderBy('published_at', 'desc')->paginate(6);

        if($request->ajax == 1)
        {
            return response()->json($news);
        }

        return inertia('News', [
            'initialArticles' => $news,
            'user' => $user,
            'filters' => $request->only(['search', 'date']),
        ]);
    }


    public function admin(Request $request)
    {
        $request->session()->now('view_name', 'admin.news.news.index');
        
        if($request->ajax()){

            $news = News::where('status', '!=', 'archived')
                ->with('user')
                ->orderBy('created_at', 'desc');

            return DataTables::of($news)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !is_null($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where('title', 'like', "%$search%");
                    }
                })

                ->addColumn('status', function($value){
                    if($value->status == 'draft')
                    {
                        return '<span class="badge bg-warning">Draft</span>';
                    }

                    if($value->status == 'published')
                    {
                        return '<span class="badge bg-success">Published</span>';
                    }

                    if($value->status == 'archived')
                    {
                        return '<span class="badge bg-danger">Archived</span>';
                    }
                })

                ->addColumn('author', function($value){
                    return $value->user->full_name ?? '';
                })

                ->addColumn('action', function ($value) {
                    $edit_button = '<div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">';

                    if($value->status == 'draft')
                    {
                        $edit_button .= '<li>
                                            <button type="submit" class="dropdown-item" onclick="publishNews(' . $value->id . ')">
                                                <i class="ri-checkbox-circle-fill align-bottom me-2 text-success"></i> Publish
                                            </button>
                                        </li>';
                    }

                    if($value->status == 'published')
                    {
                        $edit_button .= '<li>
                                            <button type="submit" class="dropdown-item" onclick="unpublishNews(' . $value->id . ')">
                                                <i class="ri-close-circle-fill align-bottom me-2 text-danger"></i> Unpublish
                                            </button>
                                        </li>';

                        $edit_button .= '<li>
                                            <button type="submit" class="dropdown-item" onclick="archiveNews(' . $value->id . ')">
                                                <i class="ri-archive-fill align-bottom me-2 text-warning"></i> Archive
                                            </button>
                                        </li>';
                    }
                        
                    // if($value->user_id == auth()->user()->id || auth()->user()->hasRole('super_admin'))
                    // {
                    
                        $edit_button .= '<li>
                                            <a href="' . route('admin.news.edit', $value->id) . '" class="dropdown-item">
                                                <i class="ri-edit-box-fill align-bottom me-2"></i> Edit
                                            </a>
                                        </li>';
                    // }

                    $edit_button .= '<li>
                                        <a href="' . route('admin.news.show', $value->id) . '" class="dropdown-item">
                                            <i class="ri-eye-fill align-bottom me-2"></i> View
                                        </a>
                                    </li>';

                    // if(auth()->user()->hasRole('super_admin'))
                    // {
                        $edit_button .= '<li>
                                            <button type="submit" class="dropdown-item delete-item-btn" onclick="deleteNews(' . $value->id . ')">
                                                <i class="ri-delete-bin-6-fill align-bottom me-2 text-danger"></i> Delete
                                            </button>
                                        </li>';
                    // }

                    $edit_button .= '</ul></div>';
                    return $edit_button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.news.news.index');
    }

    public function archiveIndex(Request $request)
    {
        $request->session()->now('view_name', 'admin.news.archive.index');
        
        if($request->ajax()){

            $news = News::where('status', 'archived')
                ->with('user')
                ->orderBy('created_at', 'desc');

            return DataTables::of($news)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && !is_null($request->search['value'])) {
                        $search = $request->search['value'];
                        $query->where('title', 'like', "%$search%");
                    }
                })

                ->addColumn('status', function($value){
                    if($value->status == 'draft')
                    {
                        return '<span class="badge bg-warning">Draft</span>';
                    }

                    if($value->status == 'published')
                    {
                        return '<span class="badge bg-success">Published</span>';
                    }

                    if($value->status == 'archived')
                    {
                        return '<span class="badge bg-danger">Archived</span>';
                    }
                })

                ->addColumn('author', function($value){
                    return $value->user->full_name ?? '';
                })

                ->addColumn('action', function ($value) {
                    $edit_button = '<div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">';

                    $edit_button .= '<li>
                                        <a href="' . route('admin.news.show', $value->id) . '" class="dropdown-item">
                                            <i class="ri-eye-fill align-bottom me-2"></i> View
                                        </a>
                                    </li>';

                    $edit_button .= '</ul></div>';
                    return $edit_button;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.news.archive.index');
    }

    public function create(Request $request)
    {
        $request->session()->now('view_name', 'admin.news.news.index');
        return view('admin.news.news.create');
    }

    public function edit(Request $request, $id)
    {
        $request->session()->now('view_name', 'admin.news.news.index');

        $news = News::findOrFail($id);

        return view('admin.news.news.edit', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = 'draft';
        $news->user_id = auth()->user()->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/news'), $image_name);
            $relative_path = '/images/news/'.$image_name;
            $news->image = $relative_path;

        }

        $news->save();

        return redirect()->route('admin.news')->with('success', 'News created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $news = News::findOrFail($id);
        $news->title = $request->title;
        $news->content = $request->content;

        if ($request->file('image')) {

            $old_image = $news->image;
            
            if($old_image)
            {
                unlink(public_path($old_image));
            }

            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/news'), $image_name);
            $relative_path = '/images/news/'.$image_name;
            $news->image = $relative_path;

        }

        $news->save();

        return redirect()->route('admin.news')->with('success', 'News updated successfully');
    }

    public function show(Request $request, $id)
    {
        $request->session()->now('view_name', 'admin.news.news.index');

        $news = News::findOrFail($id);

        return view('admin.news.news.show', compact('news'));
    }

    public function publish(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->status = 'published';
        $news->published_at = now();
        $news->save();

        return response()->json(['success' => 'News published successfully']);
    }

    public function unpublish(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->status = 'draft';
        $news->published_at = null;
        $news->save();

        return response()->json(['success' => 'News unpublished successfully']);
    }

    public function archive(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->status = 'archived';
        $news->save();

        return response()->json(['success' => 'News archived successfully']);
    }

    public function destroy(Request $request)
    {
        $news = News::findOrFail($request->id);
        $news->delete();

        return response()->json(['success' => 'News deleted successfully']);
    }
    
}
