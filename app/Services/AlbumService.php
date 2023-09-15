<?php

namespace App\Services;

use App\Http\Requests\StoreAlbumRequest;
use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AlbumService implements AlbumServiceInterface
{
    public function getUseralbums($user)
    {
        return $user->albums()->get();

    }

    public function getAlbumImages($id)
    {
        return Album::with('images')->findOrFail($id);
    }

    public function createAlbum($request, $user, $data)
    {
        $path = 'images' . DIRECTORY_SEPARATOR . $user->name . DIRECTORY_SEPARATOR . $request->name;
        $data = array_merge($data, ['user_id' => $user->id, 'path' => $path]);
        $album = Album::create($data);
        if ($request->has('images')) {
           store_image($request, $user, $album);
        }
    }

    public function deleteAlbum(Album $album, $select, $newAlbumId = null)
    {
        $username = Auth::user()->name;
        $image_path = public_path($album->path);

        if ($select == 'delete') {
            $album->images()->delete();
            remove_old_folder_from_disk($image_path);
            $album->delete();

        } elseif ($select == 'move' && $newAlbumId) {
            $oldAlbumImages = $album->images;
            $new_album = Album::findorFail($newAlbumId);
            $new_path = public_path($new_album->path);

            // check if new album has the same photo and don't move it if exist
            foreach ($oldAlbumImages as $image) {
                $img_name = $image->name;
                $exist = $new_album->images()->where('name', $img_name)->exists();
                if (!$exist) {
                    $image->update([
                        'album_id' => $new_album->id,
                        'path' => 'images/' . $username . '/' . $new_album->name . '/' . $img_name
                    ]);
                }
            }
            $album->images()->delete();
            $album->delete();
            move_files_from_folder_to_another($image_path, $new_path);
            remove_old_folder_from_disk($image_path);
        }

    }

    public function updateAlbum($album,$data)
    {
        $album->update($data);
        $album->save();
    }



}
