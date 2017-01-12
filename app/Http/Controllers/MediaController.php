<?php

namespace RedCrown\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use RedCrown\Http\Requests\MediaRequest;
use RedCrown\Media;

class MediaController extends Controller
{
    const ITEMS_PER_PAGE = 6;

    public function index()
    {
        $images = Media::query()->paginate(self::ITEMS_PER_PAGE);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('media.paginate', ['images' => $images])->render()
            ]);
        }

        return view('media.index')->with([
            'images' => $images
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
            'path' => $media->src,
            'html' => view('media.item', ['image' => $media])->render()
        ], Response::HTTP_CREATED);
    }

    public function showRandom()
    {
        $media = Media::query()->skip(mt_rand(0, Media::count() - 1))->first();

        return response()->json([
            'path' => $media->src,
            'status' => 'success'
        ]);
    }
}
