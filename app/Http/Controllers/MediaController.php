<?php

namespace RedCrown\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use RedCrown\Http\Requests\MediaRequest;
use RedCrown\Media;

class MediaController extends Controller
{
    public function index()
    {
        return view('media.index')->with([
            'images' => Media::all()
        ]);
    }

    /**
     * Сохраняет файл в медиатеку
     *
     * @param MediaRequest $request
     * @return JsonResponse
     */
    public function store(MediaRequest $request)
    {
        $file = request()->file('media');
        $file_path = $file->store('media');
        $media = Media::create([
            'filename' => $request->filename,
            'path' => $file_path,
            'size' => $file->getSize()
        ]);

        return response()->json([
            'message' => 'Файл добавлен в медиатеку',
            'path' => Media::BASE_DIR . $file_path,
            'html' => view('media.item', ['image' => $media])->render()
        ], Response::HTTP_CREATED);
    }
}
