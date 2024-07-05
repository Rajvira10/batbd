<?php

namespace App\Http\Controllers;

use App\Models\Media;
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
        $medias = Media::paginate(40);

        if($request->page){
            return response()->json($medias);
        }

        return inertia('Media', ['medias' => $medias]);
    }

    public function admin(Request $request)
    {
        $request->session()->now('view_name', 'admin.medias.index');
        try{
            $medias = $this->mediaRepository->index();

            return view('admin.media.index', compact('medias'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        $response = $this->mediaRepository->store($request);

        if($response['status'] == 'success'){
            return redirect()->route('admin.medias')->with('success', $response['message']);
        }
        else{
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function storeAjax(Request $request)
    {
        if($request->ajax())
        {
            $response = $this->mediaRepository->store($request);

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
