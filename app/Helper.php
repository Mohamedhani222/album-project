<?php

use App\Http\Requests\StoreAlbumRequest;
use Illuminate\Support\Facades\File;

function remove_old_folder_from_disk($image_path)
{
    if (file_exists($image_path)) {
        File::deleteDirectory($image_path);
    }
}

function move_files_from_folder_to_another($old_folder, $new_folder)
{
    $files = File::files($old_folder);
    foreach ($files as $file) {
        $new_path = $new_folder . DIRECTORY_SEPARATOR . $file->getFilename();
        File::copy($file->getPathname(), $new_path);
    }
}


function store_image($request, ?\Illuminate\Contracts\Auth\Authenticatable $user, $album)
{
    foreach ($request->file('images') as $key => $image) {
        $name = $image->getClientOriginalName();
        $path = '/images/' . $user->name . '/' . $album->name;
        if (!$album->images()->where('name',$name)->exists()){
            $filename = $image->storeAs($path, $name);
            $album->images()->create(['album_id' => $album->id, 'name' => $name, 'path' => $filename]);
        }elseif($album->images()->where('name',$name)->exists() && count($request->file('images')) == 1){
            throw new Exception(' image already exist');
        }
    }
}
