<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Services\AlbumServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlbumController extends Controller
{
    private AlbumServiceInterface $albumService;

    public function __construct(AlbumServiceInterface $albumService)
    {
        $this->albumService = $albumService;
    }

    public function index(): View
    {
        $albums = $this->albumService->getUseralbums(Auth::user());
        return view('albums.index', compact('albums'));
    }


    public function store(StoreAlbumRequest $request)
    {
        $user = Auth::user();
        $this->albumService->createAlbum($request, $user, $request->validated());
        return back()->withSuccess('Created Successfully');
    }

    public function show($id)
    {
        $albums_images = $this->albumService->getAlbumImages($id);
        return view('albums.show',compact('albums_images'));
    }


    public function update(StoreAlbumRequest $request, Album $album): RedirectResponse
    {
        $this->albumService->updateAlbum($album, $request->validated());
        return back();
    }

    public function destroy(Request $request, Album $album): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $select = $request->actionSelect;
            $newAlbumId = $request->new_album;
            $this->albumService->deleteAlbum($album,$select,$newAlbumId);
            DB::commit();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception  $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
