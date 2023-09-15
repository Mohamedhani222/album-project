<?php

namespace App\Services;

use App\Models\Album;

interface AlbumServiceInterface
{
    public function getUseralbums($user);

    public function getAlbumImages($id);

    public function createAlbum($request, $user, $data);

    public function deleteAlbum(Album $album, $select, $newAlbumId = null);

    public function updateAlbum($album, $data);

}
