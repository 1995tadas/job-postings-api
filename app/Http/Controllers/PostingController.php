<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostingRequest;
use App\Models\Posting;
use App\Models\PostingsTranslation;
use App\Services\PostingService;

class PostingController extends Controller
{
    public function store(PostingRequest $request): \Illuminate\Http\JsonResponse
    {
        $postingService = new PostingService();
        return $postingService->store($request);
    }

    public function index(string $lang): \Illuminate\Http\JsonResponse
    {
        $posting = Posting::get()->pluck('id');

        if ($posting->isEmpty()) {
            return response()->json(['error' => 'No records found'], 404);
        }

        $postingsTranslations = PostingsTranslation::whereIn('posting_id', $posting)->where('language', $lang)->select('posting_id', 'title')->latest()->simplePaginate(10);
        return response()->json($postingsTranslations);
    }

    public function show(string $lang, $id)
    {
        $posting = Posting::find($id);
        if ($posting) {
            $postingsTranslation = PostingsTranslation::where('language', $lang)->where('posting_id', $posting->id)->with('jobAreas')->first();
            if ($postingsTranslation) {
                return response()->json($postingsTranslation);
            }
        }

        return response()->json(['error' => 'Job posting with id ' . $id . ' don\'t exist'], 404);
    }

    public function update(PostingRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $postingService = new PostingService();
        return $postingService->update($request, $id);
    }
}
