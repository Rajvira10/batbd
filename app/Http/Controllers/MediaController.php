<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repositories\MediaRepository;

class MediaController extends Controller
{
    private $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function index(Request $request)
    {
        $galleries = Gallery::where('status', 'active')->get();
        if($galleries->isEmpty()){
            return inertia('Media', ['galleries' => $galleries, 'media' => [], 'user' => auth()->user(), 'selectedGalleryId' => null]);
        }
        $selectedGalleryId = $request->query('gallery_id', $galleries->first()->id);
        $media = Gallery::find($selectedGalleryId)->media()->paginate(40);
        $user = auth()->user();

        if ($request->gallery_id) {
            return response()->json($media);
        }

        return inertia('Media', ['galleries' => $galleries, 'media' => $media, 'user' => $user, 'selectedGalleryId' => $selectedGalleryId]);
    }

    public function admin(Request $request, $id)
    {
        $request->session()->now('view_name', 'admin.medias.index');
        try{
            $medias = $this->mediaRepository->index($id);
            $gallery = Gallery::find($id);

            return view('admin.media.index', compact('medias', 'id', 'gallery'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request, $id)
    {
        $response = $this->mediaRepository->store($request, $id);

        if($response['status'] == 'success'){
            return back()->with('success', $response['message']);
        }
        else{
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function storeAjax(Request $request, $id)
    {
        if($request->ajax())
        {
            $response = $this->mediaRepository->store($request, $id);

            if($response['status'] == 'success'){
                return response()->json(['success' => $response['message'], 'data' => $response['data']]);
            } else {
                return response()->json(['error' => $response['message']]);
            }
        }
    }

    public function update(Request $request)
    {
        if($request->ajax())
        {
            $response = $this->mediaRepository->update($request);

            if($response['status'] == 'success'){
                return response()->json(['success' => $response['message']]);
            } else {
                return response()->json(['error' => $response['message']]);
            }
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $response = $this->mediaRepository->destroy($request);

            if($response['status'] == 'success'){
                return response()->json(['success' => $response['message']]);
            } else {
                return response()->json(['error' => $response['message']]);
            }
        }
    }
}
