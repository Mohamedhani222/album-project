<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function destroy(Request $request): RedirectResponse
    {
        $image = Image::findorFail($request->image_id);
        $image->delete();
        $image_path = $image->album->path . DIRECTORY_SEPARATOR . $image->name;
        if (file_exists($image_path)) {
            File::delete($image_path);
        }
        return back();
    }

    public function store(Request $request)
    {

        try {
            $user = Auth::user();
            $album=Album::findorFail($request->album_id);
            store_image($request,$user,$album);
            return back()->with('success','added successfully');

        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());

        }
    }
}
