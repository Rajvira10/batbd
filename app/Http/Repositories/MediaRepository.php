<?php

namespace App\Http\Repositories;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaRepository
{
    public function index()
    {
        $medias = Media::latest()->paginate(50);
        return $medias;
    }

    public function store($request)
    {
        $request->validate([
            'file' => 'required|array',
            'file.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:'. app('common')->settings()->max_upload_size
        ]);

        try {
            $files = $request->file;
            foreach ($files as $file) {
                $image_name = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('images/gallery'), $image_name);
                $relative_path = '/images/gallery/'.$image_name;
                $absolute_path = public_path($relative_path);

                $media = new Media();
                $media->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $media->absolute_path = $absolute_path;
                $media->relative_path = $relative_path;
                $media->save();
            }

            return [
                'status' => 'success',
                'message' => 'Media uploaded successfully.',
                'data' => $media->toArray()
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'error',
                'message' => $th->getMessage()
            ];
        }
    }

    public function update($request)
    {
        $request->validate([
            'media_id' => 'required|exists:medias,id',
            'name' => 'required',
        ]);

        $media = Media::find($request->media_id);

        if ($media) {
            $media->name = $request->name;
            $media->save();

            return [
                'status' => 'success',
                'message' => 'Media updated successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Media not found.'
            ];
        }
    }

    public function destroy($request)
    {
        $media = Media::find($request->media_id);

        if ($media) {
            $file_path = public_path($media->relative_path);
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $media->delete();
            return [
                'status' => 'success',
                'message' => 'Media deleted successfully.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Media not found.'
            ];
        }
    }
}